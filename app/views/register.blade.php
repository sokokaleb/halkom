@extends('templates.default', ['title' => 'Daftar Akun Baru'])

@section('main-content')

	
	<div class="column" id="contentbar">

		@include('templates.general-errors')

		<div class="ui segment" id="maincontent">
			<!-- registration message -->
			<div class="ui icon message">
				<i class="edit icon"></i>
				<div class="content">
					<div class="header">Welcome new user!</div>
					<p>Registration is always free and will keep your wallet bloated.</p>
				</div>
			</div>
			<!-- registration form start -->
			<!-- <form method="POST" action="catch.php"> -->
			{{ Form::open(['url' => URL::current(), 'method' => 'post']) }}
			<div class="ui form" id="regisform">
				<!-- section 1 -->
				<h3 class="ui header">Creating Your Account</h3>
				<div class="field">
					<label>Username</label>
					<div class="ui labeled input">
						<input name="username" placeholder="Username" type="text"
						data-content="Your username may only contain alphanumerics, dots, and underscores."
						value="{{Input::old('username')}}">
						<div class="ui corner label"><i class="asterisk icon"></i></div>
					</div>
				</div>
				<div class="field">
					<label>Password</label>
					<div class="ui labeled input">
						<input name="password" placeholder="Type your password..." type="password"
						data-content="Your password must be 4&ndash;20 characters long.">
						<div class="ui corner label"><i class="asterisk icon"></i></div>
					</div>
				</div>	
				<div class="field">
					<label>Confirm Password</label>
					<div class="ui labeled input">
						<input name="password_confirmation" placeholder="Type your password again..." type="password">
						<div class="ui corner label"><i class="asterisk icon"></i></div>
					</div>
				</div>
				<!-- section 2 -->
				<div style="height: 1px;"></div>
				<h3 class="ui header">Customizing Your Profile</h3>
				<div class="field">
					<label>Display Name</label>
					<input name="full_name" placeholder="Display Name" type="text"
					data-content="So we could recognize who you are."
					value="{{Input::old('full_name')}}">
				</div>
				<div class="field">
					<label>Email Address</label>
					<input name="email" placeholder="Email Address" type="text"
					data-content="One of the ways to contact you."
					value="{{Input::old('email')}}">
				</div>
				<!-- section 3 -->
				<div style="height: 10px;"></div>
				<div style="padding-left: 10px;">
					<!--
					<div class="ui checkbox field">
						<input name="chk_sendemail" id="chk_sendemail" type="checkbox">
						<label for="chk_sendemail">Don't send me emails.</label>
					</div><br>
					-->
					<div class="ui checkbox field">
						<input name="chk_agree" id="chk_agree" type="checkbox">
						<label for="chk_agree">I have read and agreed to <a href=#> all the consequences (TOS).</a></label>
					</div><br><br>
				</div>
				<!-- submit button -->
				<input value="Create my Account" type="submit" class="ui large teal button">
			</div>
			{{ Form::close() }}
			<!-- registration form end -->
		</div>

		@include('templates.footer')
	</div>

@stop

@section('additional-assets-top')

{{ HTML::style('assets/responsiveslides/responsiveslides.edit.css') }}

@stop

@section('additional-assets-bottom')

{{ HTML::script('assets/js/behav-imageslider.js'); }}
{{ HTML::script('assets/responsiveslides/responsiveslides.min.js'); }}

@stop