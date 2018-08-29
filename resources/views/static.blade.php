@extends('base')

@section('body')
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Максимальная</th>
            <th>Минимальная</th>
            <th>Средняя</th>
            <th>Медианная</th>
        </tr>
        </thead>
        @foreach ($result as $value)
            <tr>
                <td>{{ $value['name'] }}</td>
                @foreach ($value['data'] as $v)
                    <td>{{$v}}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endsection

