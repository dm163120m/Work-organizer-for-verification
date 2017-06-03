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

@section('page')
    <div></div>
@endsection