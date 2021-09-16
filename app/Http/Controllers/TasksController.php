<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return view('tasks.index')->with('tasks', $tasks);
    }

    public function store(Request $request) {
        $task = new Task;
        $task->comment = $request->comment;
        $task->save();
        return redirect(route('tasks.index'));
    }
}
