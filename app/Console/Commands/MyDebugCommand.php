<?php

namespace App\Console\Commands;

use App\Imports\ProjectDynamicImport;
use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MyDebugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for debug some functins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //static file
        // Excel::import(new ProjectImport(Task::find(1)), 'file/projects.xlsx', 'public');

        //dynamic file
        Excel::import(new ProjectDynamicImport(Task::find(1)), 'file/projects2.xlsx', 'public');
    }
}
