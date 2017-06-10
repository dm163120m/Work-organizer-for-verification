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
			<form class="center loginForm" method="post" action="{{ url('/login') }}" >
				{!! csrf_field() !!}
				<label class="labela" for="username">Username</label>
				<input class="polja" id="username" name="username" value={{ old('username') == "/" ? "" : old('username') }} ><br/>
				<label class="labela" for="password">Password</label>
				<input class="polja" id="password" name="password" value="" type="password"/><br/>
				<button class="loginButton" type="submit">Log in</button><br/>
				<a href="/register" class="reg_link">Click here to create an account </a>
			</form>
		</div>
		@endsection
	</div>

