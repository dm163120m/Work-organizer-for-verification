@extends('auth_template')

<div class="content">
    @section('header')
        @parent
        <div class="naslov"><img class="logo" width="50px" height="50px" src="/images/logo.png" /><b>Work Organizer</b></div>
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
                <input class="polja" id="username" name="username" value={{ old('username') }} /><br/>
                <label class="labela" for="name">Name</label>
                <input class="polja" id="name" name="name" value={{ old('name') }} /><br/>
                <label class="labela" for="surname">Surname</label>
                <input class="polja" id="surname" name="surname" value={{ old('surname') }} /><br/>
                <label class="labela" for="password">Password</label>
                <input class="polja" id="password" name="password" value="" type="password"/><br/>
                <label class="labela" for="confirmPassword">Confirm Password</label>
                <input class="polja" id="confirmPassword" name="confirmPassword" value="" type="password"/><br/>
                <label class="labela" for="email">Email</label>
                <input class="polja" id="email" name="email" value={{ old('email') }}/><br/>
                <label class="labela" for="image">Image</label>
                <input class="polja" id="image" name="image" value={{ old('image') }}/><br/>
                <select class="polja">
                    <option value="">Select role</option>
                    <option value="junior">Junior</option>
                    <option value="senior">Senior</option>
                </select>
                <button class="loginButton" type="submit">Sign up</button><br/>
            </form>
        </div>
    @endsection
</div>