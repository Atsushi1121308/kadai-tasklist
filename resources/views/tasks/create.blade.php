{{--これでレイアウトの継承をする--}}
@extends('layouts.app')

@section('content')

    <h1>タスク追加ページ</h1>

    <div class="row">
        <div class="col-6">
            {{--Form::model~Form::close()がformタグを表している--}}
            {{--$messageはコントローラで宣言したインスタンスを引数として受け取っている--}}
            
            {!! Form::model($task, ['route' => 'tasks.store']) !!}
                
                {{--Form::label('content', 'タスク:')において--}}
                {{--content＝上記$messageインスタンスの中のcontentカラムを与える。つまり，送信した値がcontentに入りますということ--}}
                {{--Form::text('content', null, ['class' => 'form-control'])において--}}
                {{--nullは初期のtextboxに入る値が空ということで，最後は情報属性（ボタンならボタンの属性があり今回は，formだったということ--}}
                
                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection