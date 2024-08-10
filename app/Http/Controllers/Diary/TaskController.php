<?php

namespace App\Http\Controllers\Diary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskCreateRequest;
use App\Http\Requests\Tasks\TaskUpdateRequest;
use App\Models\Diary\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('modules.Diary.Tasks.index', ['tasks' => Task::all()]);
    }

    public function create()
    {
        return view('modules.Diary.Tasks.create');
    }

    public function store(TaskCreateRequest $request)
    {
        Task::create($request->validated());

        return back();
    }

    public function show(Task $task)
    {
//
    }

    public function edit(Task $task)
    {
        return view('modules.Diary.Tasks.edit', ['task' => $task]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
