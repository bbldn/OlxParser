@extends('base')

@section('head')
    <style>
        iframe {
            width: 100%;
            height: 99vh;
        }
    </style>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <ul>
                    <li><a href="/1">Количество комнат</a></li>
                    <li><a href="/2">Этажность</a></li>
                    <li><a href="/3">Этаж</a></li>
                    <li><a href="/4">Площадь</a></li>
                    <li><a href="/5">Цена</a></li>
                </ul>
            </div>
            <div class="col-10">
                <iframe src="{{$src}}"></iframe>
            </div>
        </div>
    </div>
@endsection

