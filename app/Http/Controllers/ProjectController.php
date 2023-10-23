<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ImportStoreRequest;
use App\Jobs\ImportProjectFromExcelJob;
use App\Models\File;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return inertia('Project/Index');
    }

    public function import()
    {
        return inertia('Project/Import');
    }

    public function importStore(ImportStoreRequest $request)
    {
        $data = $request->validated();

        $file = File::putAndCreate($data['file']);
        $path = $file->path;

        $task = Task::create([
            'user_id' => auth()->id(),
            'file_id' => $file->id,
        ]);
        ImportProjectFromExcelJob::dispatchSync($path, $task);
        // dd($path);
    }
}
