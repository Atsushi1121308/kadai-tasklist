<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    
    // タスク一覧
    public function index()
    {
        $data = [];
        if (\Auth::check()) { 
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        return view('tasks.index', $data);
    }
    
    // タスク投稿コントローラ
    public function store(Request $request)
    {
        $request->validate(['content' => 'required|max:255', 'status' => 'required|max:10',]);
        $request->user()->tasks()->create([
            'content' => $request->content, 
            'status' => $request->status,
        ]);
        return redirect('/');
    }

    public function create()
    {
        $task = new Task;
        return view('tasks.create', ['task' => $task,]);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) { 
            return view('tasks.show', ['task' => $task,]);
        }
        else{
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) { 
            return view('tasks.edit', ['task' => $task,]);
        }
        else{
            // トップページへリダイレクトさせる
            return redirect('/');   
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate(['content' => 'required|max:255', 'status' => 'required|max:10',]);
        $task = Task::findOrFail($id);
        // ログインユーザーのidが一致した場合のみという条件
        if (\Auth::id() === $task->user_id) {    
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();
            return redirect('/');
        }    
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        // ログインユーザーのidが一致した場合のみという条件
        if (\Auth::id() === $task->user_id) {
            $task->delete();
            return redirect('/');
        }
        else{
            // トップページへリダイレクトさせる
            return redirect('/');   
        }
    }
}
