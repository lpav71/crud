@extends('layouts.app')
@section('content')

    <h1 class="head">Добавление записи</h1>

    {!! Form::open(['action' =>'NoteController@store', 'method' => 'POST','files'=>true])!!}

    <div class="col-md-6">

        <div class="form-group required">
            {!! Form::label("Наименование") !!}
            {!! Form::text("name", null ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="form-group required">
            {!! Form::label("Артикул") !!}
            {!! Form::text("artikul", null ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="form-group required">
            {!! Form::label("Изображение") !!}
            {!! Form::file("image1", null ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="form-group required">
            {!! Form::label("Изображение") !!}
            {!! Form::file("image2", null ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="form-group required">
            {!! Form::label("Изображение") !!}
            {!! Form::file("image3", null ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="well well-sm clearfix">
            <button class="btn btn-success pull-right" title="Save" type="submit">Create</button>
        </div>
    </div>

    {!! Form::close() !!}

@endsection