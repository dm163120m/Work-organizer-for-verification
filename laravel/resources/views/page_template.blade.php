@extends('template')

@section('sidebar')
        <div class="sidebar-nav col-md-12">
            <a href="/{{$data['role']}}/home#">Home</a>
            <a href="/{{$data['role']}}/tasks#">My Tasks</a>
            <a href="/{{$data['role']}}/tests#">Tests</a>
        </div>
@endsection