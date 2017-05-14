@extends('template')

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
			<form class="center loginForm" method="post" action="{{ url('/login') }}" >
				{!! csrf_field() !!}
				<label class="labela" for="username">Username</label>
				<input class="polja" id="username" name="username" value="" /><br/>
				<label class="labela" for="password">Password</label>
				<input class="polja" id="password" name="password" value="" type="password"/><br/>
				<button class="loginButton" type="submit">Log in</button><br/>
				<a href="/register" class="reg_link">Click here to create an account </a>
			</form>
		</div>
		@endsection
	</div>

