<?php

namespace Orbitali\Console;

use Illuminate\Console\Command;

class RemoveUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "orbitali:remove-unused-files";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This artisan remove unused asset files.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $disk = \Storage::disk("public");
        $files = collect($disk->allFiles())->diff(['.gitignore']);
        $existFiles = \Orbitali\Http\Models\Search::query()
            ->where(function ($q) {
                $content = "%/%";
                $q->WhereRaw("lower(`name`) like ?", [$content])
                    ->orWhereRaw(
                        "JSON_VALID(JSON_SEARCH(lower(`value`), 'all', lower(?))) = 1",
                        [$content]
                    )
                    ->orWhereRaw(
                        "JSON_VALID(JSON_SEARCH(lower(`detail_value`), 'all', lower(?))) = 1",
                        [$content]
                    );
            })
            ->pluck("value")
            ->flatten()
            ->filter(fn($a)=>$disk->fileExists($a ?? ""));
        $removedFiles = $files->diff($existFiles);

        $logs = clock()->userData("logs")->title("Logs");
        $logs->counters(['Removed File Count' => $removedFiles->count()]);
        $logs->table('Removed', $removedFiles->map(fn($a)=>[ "File"=> $a ])->toArray());
        $disk->delete($removedFiles->toArray());
    }
}
