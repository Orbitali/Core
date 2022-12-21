<?php

namespace Orbitali\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Http\Models\Task;
use Illuminate\Http\Request;
use Orbitali\Foundations\Helpers\Eloquent;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entries = Task::query();

        $columns = (new Task(["id" => 0]))->structure->columns;

        Eloquent::queryBuilder(
            $entries,
            $columns->pluck("name")->toArray(),
            $request->get("q", "")
        );

        $entries = $entries->paginate(25)->withQueryString();

        $blockOptions = [
            "query" => $entries,
            "columns" => $columns,
            "title" => trans(["native.panel.task.title", "Task"]),
            "search" => true,
            "options" => [
                [
                    "route" => route("panel.task.create"),
                    "title" => trans([
                        "native.panel.task.add",
                        "Yeni task ekle",
                    ]),
                    "icon" => "fa-plus",
                    "text" => "",
                ],
            ],
            "actions" => [
                function ($entity) {
                    return [
                        "route" => route("panel.task.run", $entity),
                        "title" => trans([
                            "native.panel.task.actions.run",
                            "Çalıştır",
                        ]),
                        "icon" => "fa-play",
                        "class" => "js-action",
                        "text" => html()
                            ->form("POST", route("panel.task.run", $entity))
                            ->class("d-none"),
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.task.show", $entity),
                        "title" => trans([
                            "native.panel.task.show",
                            "Görüntüle",
                        ]),
                        "icon" => "fa-eye",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.task.edit", $entity),
                        "title" => trans(["native.panel.task.edit", "Düzenle"]),
                        "icon" => "fa-pencil-alt",
                        "text" => "",
                    ];
                },
                function ($entity) {
                    return [
                        "route" => route("panel.task.destroy", $entity),
                        "title" => trans(["native.panel.task.destroy", "Sil"]),
                        "icon" => "fa-times",
                        "class" => "js-destroy",
                        "text" => html()
                            ->form(
                                "DELETE",
                                route("panel.task.destroy", $entity)
                            )
                            ->class("d-none"),
                    ];
                },
            ],
        ];

        return view("Orbitali::inc.list", $blockOptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $model = Task::preCreate();
        if ($model !== false) {
            return redirect(route("panel.task.edit", $model));
        }
        return redirect()
            ->back()
            ->withErrors(
                trans([
                    "native.panel.task.message.create.error",
                    "Task oluşturulamadı",
                ])
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Task $task
     * @return Response
     */
    public function show(Request $request, Task $task)
    {
        $entries = $task
            ->logs()
            ->paginate(25)
            ->withQueryString();
        $entries->each(function ($q) {
            $q->status = $q->commandExitCode == 0 ? "success" : "danger";
        });
        return view("Orbitali::task.show", compact("task", "entries"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return Response
     */
    public function edit(Task $task)
    {
        $task->structure;
        return view("Orbitali::task.edit", compact("task"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Task $task
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Task $task)
    {
        html()->model($task);
        $structure = $task->structure;
        list($rules, $names) = Structure::parseStructureValidations(
            $structure,
            $task
        );

        $inputs = $this->validate($request, $rules, [], $names);
        $task->forceFill($inputs);
        $task->save();
        return redirect()->to(route("panel.task.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        if ($task->delete() !== false) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.task.message.destroy.success",
                        ":key silme işlemi başarılı.",
                    ],
                    ["key" => $task->key]
                )
            );
        } else {
            session()->flash(
                "danger",
                trans(
                    [
                        "native.panel.task.message.destroy.danger",
                        ":key silme işlemi hatalı.",
                    ],
                    ["key" => $task->key]
                )
            );
        }
        return redirect()->back();
    }

    /**
     * Run the task
     *
     * @param  Task $task
     * @return Response
     */
    public function run(Task $task)
    {
        $command = "$task->command $task->parameters";
        if (has_shell_access()) {
            $artisan = base_path("artisan");
            exec("php $artisan $command", $output, $exitCode);
        } else {
            $exitCode = Artisan::call($command);
        }

        if ($exitCode == 0) {
            session()->flash(
                "success",
                trans(
                    [
                        "native.panel.task.run.success",
                        ":key çalıştırma başarılı.",
                    ],
                    ["key" => $task->key]
                )
            );
        } else {
            session()->flash(
                "danger",
                trans(
                    ["native.panel.task.run.danger", ":key çalıştırma hatalı."],
                    ["key" => $task->key]
                )
            );
        }
        return redirect()->back();
    }
}
