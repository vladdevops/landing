@extends('layout')

@section('content')
    <ul>
        @for($i=1;$i<=5;$i++)
            <li>
                <a href="{{route('page', $i)}}"
                   @if($page == $i)style="{{'font-weight: 800;'}}"@endif
                >
                    Page {{$i}}
                </a>
            </li>
        @endfor
    </ul>
    <br>
    <a href="{{route('admin.activity')}}">
        Admin activity
    </a>
@endsection
