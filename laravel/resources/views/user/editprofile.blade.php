@extends('page_template')

<div class="content">
    @section('header')
        @parent
    @endsection
    @section('page')
        <div>
            <h2 class="userName" style= "font-size: 30px; color:#423F47; text-align: center" > {{$data['firstName']}} {{$data['secondName']}}</h2>
            @if($errors->has())
                @foreach ($errors->all() as $error)
                    <div class="errorMsg center">{{ $error }}</div>
                @endforeach
            @endif
            @if(Session::has('msg'))
                <div class="errorMsg center"> {{Session::get('msg')}} </div>
            @endif
            <form class="center loginForm" method="post"  action="{{ url('/editprofile') }}"  >
                {!! csrf_field() !!}
                <label class="labela2" for="password">New Password</label>
                <input class="polja" id="password" name="password" value="" type="password"/><br/>
                <label class="labela2" for="confirmPassword">Confirm Password</label>
                <input class="polja" id="confirmPassword" name="confirmPassword" value="" type="password"/><br/>
                <label class="labela2" for="email">Email</label>
                <input class="polja" id="email" name="email" value={{ old('email') }}/><br/>
                <label class="labela2" for="image">Image</label>
                <input class="polja" id="image" name="image" value={{ old('image') }}/><br/>

                <button class="saveChangesButton" style="margin-left:92px;margin-bottom:200px;width:120px;padding-bottom: 5px;" type="submit">Save changes</button><br/>

            </form>
        </div>
    @endsection
</div>