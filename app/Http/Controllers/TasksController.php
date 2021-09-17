<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return view('tasks.index')->with('tasks', $tasks);
    }

    public function store(TaskRequest $request) {
        $task = new Task;
        $task->comment = $request->comment;
        $task->save();
        return redirect(route('tasks.index'));
    }

    public function destroy(Request $request) {
        $task = Task::find($request->id);
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
