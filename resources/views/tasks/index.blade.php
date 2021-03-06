@extends('layouts.app')

@section('content')

    {{--ログインできている場合の表示--}}
    @if (Auth::check())
    <h1>タスク一覧</h1>
        @if (count($tasks) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タスク</th>
                        <th>状態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        {{-- メッセージ詳細ページへのリンク --}}
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        {{-- メッセージ作成ページへのリンク --}}
        {{-- !!で囲うとhtmlspecialchars関数に通されずそのまま出力される --}}
        {!! link_to_route('tasks.create', '新規タスクの追加', [], ['class' => 'btn btn-primary']) !!}

    {{--ログイン出来ていない場合の表示--}}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>タスク管理サイトへようこそ！</h1>
                {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif

@endsection