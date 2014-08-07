@extends('templates.default', ['title' => 'Account Settings'])

@section('main-content')

	<div class="column" id="contentbar">

		@include('templates.general-errors')

		<div class="ui segment" id="maincontent">
			<!-- registration message -->
			<div class="ui icon message">
				<i class="settings icon"></i>
				<div class="content">
					<div class="header">Account Settings</div>
					<p>Manage your account here.</p>
				</div>
			</div>
			<!-- tabular menu -->
			<div class="ui tabular menu" id="profiletab">
				<a id="proftab1" class="active item" onclick="proftabclick(1)">Change Profile</a>
				<a id="proftab2" class="item" onclick="proftabclick(2)">Profile Picture</a>
				<a id="proftab3" class="item" onclick="proftabclick(3)">Change Password</a>
			</div>
			<!-- registration form start -->
			{{Form::open(['url' => '/user/update-profile', 'method' => 'post', 'files' => true])}}
			<div class="ui form" id="regisform">
				<!-- section 3 -->
				<div class="section" id="profsec3">
					<h3 class="ui header">Change Password</h3>
					<div class="field">
						<label>Old Password</label>
						<div class="ui labeled input">
							<input name="old_password" placeholder="Type your old password..." type="password"
							data-content="Type your old password.">
							<div class="ui corner label"><i class="lock icon"></i></div>
						</div>
					</div>					
					<div class="field">
						<label>New Password</label>
						<div class="ui labeled input">
							<input name="password" placeholder="Type your new password..." type="password"
							data-content="Your new password must be 4&ndash;20 characters long.">
							<div class="ui corner label"><i class="lock icon"></i></div>
						</div>
					</div>	
					<div class="field">
						<label>Confirm New Password</label>
						<div class="ui labeled input">
							<input name="password_confirmation" placeholder="Type your new password again..." type="password">
							<div class="ui corner label"><i class="lock icon"></i></div>
						</div>
					</div>
				</div>
				<!-- section 1 -->
				<div class="section" id="profsec1">
					<h3 class="ui header">Customizing Your Profile</h3>
					<div class="field">
						<label>Display Name</label>
						<input name="full_name" placeholder="Display Name" type="text" value="{{Auth::user()->full_name}}"
						data-content="So we could recognize who you are.">
					</div>
					<div class="field">
						<label>Email Address</label>
						<input name="email" placeholder="Email Address" type="text" value="{{Auth::user()->email}}"
						data-content="One of the ways to contact you.">
					</div>
					<!-- Emailing, not yet supported
					<div style="padding-left: 10px;">
						<div class="ui checkbox field" style="margin-bottom:0">
							<input name="chk_sendemail" id="chk_sendemail" type="checkbox">
							<label for="chk_sendemail">Don't send me emails.</label>
						</div>
					</div>
					-->
				</div>
				<!-- section 2 -->
				<div class="section" id="profsec2">
					<h3 class="ui header">Change Your Avatar</h3>
					<div class="ui form segment">
						<img src="{{asset('assets/img/avatars/' . Auth::user()->avatar_filename)}}">
						<div class="field"><input name="avatar" id="file" type="file" class="file"></div>
					</div>
				</div>
				<!-- submit button -->
				<br>
				<input value="Save Changes" type="submit" class="ui teal button">
				<input value="Reset" type="reset" class="ui button">
			</div>
			{{Form::close()}}
			<!-- registration form end -->
		</div>
	</div>

@stop

@section('additional-assets-top')

@stop

@section('additional-assets-bottom')

{{ HTML::script('assets/js/behav-main.js'); }}
{{ HTML::script('assets/js/behav-editprofile.js'); }}

@stop