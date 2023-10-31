<?php

namespace App\Jobs;

use App\Imports\ProjectDynamicImport;
use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportProjectFromExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $path;
    private Task $task;
    /**
     * Create a new job instance.
     */
    public function __construct(string $path, Task $task)
    {
        $this->path = $path;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $importMethodName = 'import' . $this->task->type;
        $this->$importMethodName();
    }

    private function import1()
    {
        Excel::import(new ProjectImport($this->task), $this->path, 'public');
    }
    private function import2()
    {
        Excel::import(new ProjectDynamicImport($this->task), $this->path, 'public');
    }
}
