@extends('layouts.app')

@section('content')
    @if (Auth::id() == $task->user_id)
        <h1>id = {{ $task->id }} のタスク詳細ページ</h1>
    
        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <td>{{ $task->id }}</td>
            </tr>
            <tr>
                <th>タスク</th>
                <td>{{ $task->content }}</td>
            </tr>
            <tr>
                <th>状態</th>
                <td>{{ $task->status }}</td>
            </tr>
        </table>
        
        <div style="display: inline-block;">
        {{-- メッセージ編集ページへのリンク --}}
        {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $task->id], ['class' => 'btn btn-light']) !!}
        </div>
        
         <div style="display: inline-block; margin-left: 20px;">
        {{-- メッセージ削除フォーム --}}
        {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        </div>
    @endif

@endsection