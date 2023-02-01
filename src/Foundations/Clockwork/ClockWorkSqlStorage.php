<?php

namespace Orbitali\Foundations\Clockwork;

use Clockwork\Clockwork;
use Clockwork\Request\Request;
use Clockwork\Storage\Search;
use Clockwork\Storage\Storage;
use Illuminate\Support\Facades\Log;
use Orbitali\Http\Models\ClockworkEntry;

class ClockWorkSqlStorage extends Storage
{
	public function all(Search $search = null)
	{
        //WHERE (`uri` LIKE :uri0 OR `uri` LIKE :uri1 OR
        //`commandName` LIKE :commandName0 OR `commandName` LIKE :commandName1
        //OR `jobName` LIKE :jobName0 OR `jobName` LIKE :jobName1
        //OR `testName` LIKE :testName0 OR `testName` LIKE :testName1)
		//$search = SqlSearch::fromBase($search, $this->pdo);
        $collection = ClockworkEntry::get();
		return $this->mapCollectionToResponse($collection);
	}

    public function find($id)
	{
        $model = ClockworkEntry::find($id);
		return $this->mapModelToResponse($model);
	}

	public function latest(Search $search = null)
	{
        $model = ClockworkEntry::orderBy('id', 'desc')->first();
		return $this->mapModelToResponse($model);
	}

	public function previous($id, $count = 10, Search $search = null)
	{
		//$search = SqlSearch::fromBase($search, $this->pdo)->addCondition('id < :id', [ 'id' => $id ]);
        $collection = ClockworkEntry::where("id", "<", $id)
                            ->orderBy('id', 'desc')
                            ->take($count)
                            ->get()
                            ->reverse();
        return $this->mapCollectionToResponse($collection);
	}

	public function next($id, $count = 10, Search $search = null)
	{
		//$search = SqlSearch::fromBase($search, $this->pdo)->addCondition('id > :id', [ 'id' => $id ]);
        $collection = ClockworkEntry::where("id", ">", $id)
                            ->orderBy('id', 'asc')
                            ->take($count)
                            ->get();
        return $this->mapCollectionToResponse($collection);
	}

	public function store(Request $request)
	{
		$data = $request->toArray();
        $entity = new ClockworkEntry($data);
        $entity->save();
	}

	public function update(Request $request)
	{
		$data = $request->toArray();
        ClockworkEntry::find($data["id"])->fill($data)->save();
	}

	public function cleanup()
	{
        ClockworkEntry::where("time", "<", now()->subDays(60)->timestamp)->delete();
	}

	public function mapModelToResponse($model)
	{
		return new Request($model->toArray());
	}

	private function mapCollectionToResponse($collection)
	{
		return $collection->map([$this,"mapModelToResponse"])->values()->toArray();
	}
}
