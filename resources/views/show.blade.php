@extends('layouts.app')
@section('content')
    <h1 class="head">Просмотр записи</h1>

    <p class="nm">Наименование товара - {{$note->name}}</p>
    <p class="nm">Артикул товара - {{$note->artikul}}</p>
    <div class="row">
            @foreach($images as $image)
                <div class="col-md-4">
                    <img src='/img/{{$image->img}}' alt="" style="width: 300px"/>
                </div>
            @endforeach
        </div>
@endsection