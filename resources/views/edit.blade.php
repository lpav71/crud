@extends('layouts.app')
@section('content')

    <h1 class="head">Редактирование записи</h1>

    {{ Form::model($note, array('route' => array('note.update', $note->id), 'method' => 'PUT', 'files'=>true)) }}


        <div class="form-group required">
            {!! Form::label("Наименование") !!}
            {!! Form::text("name", $note->name ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="form-group required">
            {!! Form::label("Артикул") !!}
            {!! Form::text("artikul", $note->artikul ,["class"=>"form-control","required"=>"required"]) !!}
        </div>

        <div class="row">
        <?php $i = 1 ?>
        @foreach($images as $image)
            <?php $im = "image" . $i ?>
            <?php $id_img = "id_img" . $i ?>
            <div class="col-md-4">
                <img src='/img/{{$image->img}}' alt="" style="width: 300px"/>
                <div class="form-group required">
                    {!! Form::label("Изображение") !!}
                    <input name={{$im}} type="file">
                    {{--{!! Form::hidden('id_image',$image->id) !!}--}}
                    <input name={{$id_img}} type="hidden" value="{{$image->id}}">
                </div>
            </div>
            <?php $i++ ?>
        @endforeach
        </div>
        {!! Form::hidden('summ',$i-1) !!}

        <div class="well well-sm clearfix">
            <button class="btn btn-success pull-right" title="Save" type="submit">Изменить</button>
        </div>

    {!! Form::close() !!}
@endsection