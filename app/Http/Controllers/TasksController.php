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

    // URI tasks/{task} の{task}パラメーターを$idとして受け取っているが変数名は任意でよい
    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect(route('tasks.index'));
    }

    public function update($id) {
        $task = Task::find($id);
        if($task->status === 0) {
            $task->status = 1;
        } else {
            $task->status = 0;
        }
        $task->update();
        return redirect(route('tasks.index'));
    }
}
