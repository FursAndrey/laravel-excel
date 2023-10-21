<?php

namespace App\Console\Commands;

use App\Imports\ProjectImport;
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
        Excel::import(new ProjectImport(), 'file/projects.xlsx', 'public');
    }
}
