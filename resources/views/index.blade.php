@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="head">Общая таблица данных</h1>
         <a href="/note/create" class="btn btn-success create"> + Добавить</a></div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->name }}</td>
                        <td>{{ $note->artikul }}</td>
                        <td>
                            <a href="/note/{{ $note->id }}" class="btn btn-info">Просмотр</a>
                            <a href="/note/{{ $note->id }}/edit" class="btn btn-success">Редактирование</a>

                            {{ Form::open(array('url' => 'note/' . $note->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Удаление', array('class' => 'btn btn-danger del')) }}
                            {{ Form::close() }}
                            <a href="/note/json/{{ $note->id }}" class="btn btn-primary json">JSON</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection