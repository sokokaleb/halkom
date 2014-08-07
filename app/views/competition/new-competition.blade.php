@extends('templates.default', ['title' => 'Daftar Kompetisi'])

@section('main-content')

	<!-- main content -->
	<div class="column" id="contentbar">

		@include('templates.general-errors')

		<div class="ui segment" id="maincontent">
			<!-- general message -->
			<div class="ui icon message">
				<i class="edit icon"></i>
				<div class="content">
					<div class="header">Submit New Competition</div>
					<p>Know upcoming competition? Help us spread the words!</p>
				</div>
			</div>
			<!-- competition edit form start -->
			<!-- <form method="POST" action="catch.php"> -->
			{{Form::open(['url' => URL::current(), 'method' => 'POST', 'files' => true])}}
			<div class="ui form" id="competitionform">

				<input name="user_id" type="hidden" value="{{Auth::user()->id}}">

				<!-- section 1 -->
				<div class="section">
					<h3 class="ui header">Basic Information</h3>
					<div class="field">
						<label>Competition Name</label>
						<div class="ui labeled input">
							<input name="title" placeholder="Competition Name" type="text"
							data-content="This also acts as the title of your post." value="{{Input::old('title')}}">
							<div class="ui corner label"><i class="asterisk icon"></i></div>
						</div>
					</div>
					<div class="field">
						<label>Brief Information <span style="float:right" id="teasercount">140 remaining</span></label>
						<textarea name="description" class="small" id="txt_compteaser" onkeyup="countteaser()"
						placeholder="Write short description about the competition..." maxlength=140
						data-content="This will help people get the overall idea of the competition." value="{{Input::old('description')}}">{{Input::old('description')}}</textarea>
					</div>
					<div class="date field">
						<label>Competition End Date</label>
						<input name="end_date" type="text" placeholder="dd-mm-yyyy" value="{{Input::old('end_date')}}">
					</div>
				</div>
				<!-- section 2 -->
				<div class="section">
					<h3 class="ui header">Competition Banner/Poster</h3>
						<div class="ui message">
							<b>To be used properly within this website, banner/poster should:</b>
							<ul class="list">
								<li>Have width of at least <code>960</code> pixel.</li>
								<li>Have height of at least <code>480</code> pixel.</li>
								<li>Ratio of height:width is <code>1:2</code></li>
							</ul>
						</div>
						<div class="imgcont large"></div>
						<div class="field"><input name="banner" id="file" type="file" class="file"></div>
				</div>
				<!-- section 3 -->
				<div class="section">
					<h3 class="ui header">Competition Details</h3>
					<div class="ui yellow message" id="editorloader"><i class="warning icon"></i>You should activate JavaScript for better interactivity.</div>
					<div class="ui message">
						<b>A good details about a competition must have:</b>
						<ul class="list">
							<li>Contact information of the official(s).</li>
							<li>Link that redirects to the official site of the competition.</li>
						</ul>
						<p>We currently doesn't support additional image uploading for competition details.</p>
					</div>
					<div class="field" id="ckeditcont"><div id="compdetailscont">
						<textarea name="content" class="large" id="txt_compdetails"
						placeholder="Add important details about the competition..." value="{{Input::old('content')}}"></textarea>
					</div></div>
					<div class="field"></div>
				</div>
				<!-- section 4 -->
				<div class="section">
					<h3 class="ui header">Milestone Entries</h3>
					<div class="ui yellow message"><i class="heart icon"></i>Sorry for your inconvenience. We will develop a better method.</div>
					<div class="ui message">
						<b>How to register milestone entries:</b>
						<ul class="list">
							<li>Format for each entry is as follows: &nbsp; <i><code>DD-MM-YYYY: MilestoneMessage</code></i>.<br>
							For example: &nbsp; <code>17-08-2015: Indonesian Independence Day Celebration</code></li>
							<li>Entries are seperated by line break(s).</li>
							<li>Our system will parse the entries upon submission.</li>
						</ul>
					</div>
					<textarea name="milestones" class="large" id="txt_milestones"
					placeholder="Register milestone entries here..." value="{{Input::old('milestones')}}">{{Input::old('milestones')}}</textarea>
				</div>
				<!-- submit button -->
				<br>
				<input value="Submit Entry" type="submit" class="ui teal button" onclick="appenddata()">
				<!-- <input value="Preview" type="reset" class="ui button"> -->
			</div>
			{{Form::close()}}
			<!-- registration form end -->
		</div>
		@include('templates.footer')
	</div>

@stop

@section('additional-assets-top')

{{ HTML::script('assets/ckeditor/ckeditor.js'); }}

@stop

@section('additional-assets-bottom')

{{ HTML::script('assets/js/behav-main.js'); }}
{{ HTML::script('assets/js/behav-editcompetition.js'); }}

<script>
	
	<?php
		$oldcontent = Input::old('content');
		if (is_string($oldcontent))
		{
			$oldcontent = str_replace("\r", "", $oldcontent);
			$oldcontent = str_replace("\n", "", $oldcontent);
		}
	?>

	$(document).ready(function()
	{
		CKEDITOR.instances.editor1.setData("{{$oldcontent}}");
	});
</script>

@stop