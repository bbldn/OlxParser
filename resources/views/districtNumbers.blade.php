@extends('base')

@section('body')
    <table class="table">
        <thead>
        <th></th>
        @for($i = 1; $i <= $max; $i++)
            <th>{{ $i }}</th>
        @endfor
        </thead>
        @foreach ($districts as $district)
            <tr>
                <td>{{ $district->name }}</td>
                @for($i = 1; $i <= $max; $i++)
                    <td>{{ array_key_exists($i, $district->data) ? $district->data[$i] : '-'  }}</td>
                @endfor
            </tr>
        @endforeach
    </table>
@endsection
