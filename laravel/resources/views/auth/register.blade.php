{{-- Dragana Spasic 2016/3256 --}}

@extends('auth_template')

<div class="content">
    @section('header')
        @parent
        <div class="naslov"><div class="logo"><img src="/images/logo.png" /></div><b>Work Organizer</b></div>
    @endsection
    @section('content')
        <div class="login_wrapper center">
            @if($errors->has())
                @foreach ($errors->all() as $error)
                    <div class="errorMsg center">{{ $error }}</div>
                @endforeach
            @endif
            @if(Session::has('msg'))
                <div class="errorMsg center"> {{Session::get('msg')}} </div>
            @endif
            <form class="center loginForm" method="post" action="{{ url('/register') }}" >
                {!! csrf_field() !!}
                <label class="labela" for="username">Username</label>
                <input class="polja" id="username" name="username" value={{ old('username') }} ><br/>
                <label class="labela" for="Name">Name</label>
                <input class="polja" id="Name" name="Name" value={{ old('Name') }} ><br/>
                <label class="labela" for="Surname">Surname</label>
                <input class="polja" id="Surname" name="Surname" value={{ old('Surname') }} ><br/>
                <label class="labela" for="password">Password</label>
                <input class="polja" id="password" name="password" value="" type="password"><br/>
                <label class="labela" for="password_confirmation ">Confirm Password</label>
                <input class="polja" id="password_confirmation " name="password_confirmation" value="" type="password"><br/>
                <label class="labela" for="email">Email</label>
                <input class="polja" id="email" name="email" value={{ old('email') }}><br/>
                <label class="labela" for="imageUrl">Image</label>
                <input class="polja" id="imageUrl" name="imageUrl" value={{ old('imageUrl') }}><br/>
                <select class="polja" name="role">
                    <option value="">Select role</option>
                    <option value="junior">Junior</option>
                    <option value="senior">Senior</option>
                </select>
                <button class="loginButton" type="submit">Sign up</button><br/>
            </form>
        </div>
    @endsection
</div>