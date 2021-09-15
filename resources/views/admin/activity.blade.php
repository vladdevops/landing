@extends('layout')

@section('content')
    <a href="{{route('page')}}">
        Pages
    </a>
    <br>
    <table>
        <thead>
        <tr>
            <th>Url</th>
            <th>Count</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($paginator as $row)
            <tr>
                <td>{{$row['url']}}</td>
                <td>{{$row['count']}}</td>
                <td>{{$row['created_at']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>

    {{$paginator->links()}}
@endsection
