@extends('template')

@section('header')
    @parent
    <div class="header">
        <div class="logo"><img src="/images/logo.png" /></div>
        <div class="userMenu">
            <h2 class="userName">{{$firstName}} {{$secondName}}</h2>
            <img class="avatar" src="{{asset($avatar)}}" />
        </div>
    </div>
@endsection

@section('sidebar')
    @parent
    <div class="sidebar col-md-12">
        <div class="sidebar-nav col-md-12">
            <a href="#">Home</a>
            <a href="#">My Tasks</a>
            <a href="#">Tests</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="col-md-2">
        </div>
        <div class="col-md-7 page">

        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection