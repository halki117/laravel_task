<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    public function index() {
       
        // ラジオボタンが押された時（localhost/tasks?range=0 の様にurlにパラメータが付く時）の処理をif文内に書く
        if($_GET) {
            $range = $_GET['range'];

            if ($range === "0") {
                $tasks = Task::all();
            } elseif ($range === "1") {
                $tasks = Task::where('status', 0)->get();
            } else {
                $tasks = Task::where('status', 1)->get();
            }
            return view('tasks.index', compact('tasks', 'range'));
        }

        // localhost/tasks でアクセスした際の処理
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
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
