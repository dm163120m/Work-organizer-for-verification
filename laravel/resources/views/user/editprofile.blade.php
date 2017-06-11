{{-- Dragana Spasic 2016/3256 --}}

@extends('page_template')

<div class="content">
    @section('header')
        @parent
    @endsection
    @section('page')
        <div>
            <div style="text-align: center" >
                 <h2 class="userName" style= "font-size: 30px; color:#423F47;" > {{$data['firstName']}} {{$data['secondName']}}</h2>
            </div>
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
                <input class="polja2" id="password" name="password" value="" type="password"><br/>
                <label class="labela2" for="confirmPassword">Confirm Password</label>
                <input class="polja2" id="confirmPassword" name="confirmPassword" value="" type="password"><br/>
                <label class="labela2" for="email">Email</label>
                <input class="polja2" id="email" name="email" value={{ $data['email'] }}><br/>
                <label class="labela2" for="image">Image</label>
                <input class="polja2" id="image" name="imageUrl" value={{ $data['avatar'] }}><br/>

                <button class="saveChangesButton" type="submit">Save changes</button><br/>

            </form>
        </div>
    @endsection
</div>