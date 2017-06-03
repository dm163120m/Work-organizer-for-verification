@extends('template')

@section('header')
    @parent
@endsection

@section('list')
<div>
    <ul>
        @foreach ($data['tasks'] as $task)
            <li>{{ $task['title'] }}</li>
        @endforeach
    </ul>
</div>
@endsection

@section('page')
    <div></div>
@endsection