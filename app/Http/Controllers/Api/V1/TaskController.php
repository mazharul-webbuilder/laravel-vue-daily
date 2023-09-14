<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskReqeust;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());

        return TaskResource::make($task);
    }


    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function update(UpdateTaskReqeust $reqeust, Task $task)
    {
        $task->update($reqeust->validated());

        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
