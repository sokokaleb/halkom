@extends('templates.default', ['title' => $info->title])

@section('main-content')

	<div class="column" id="contentbar">
		<div class="ui segment" id="maincontent">
			<h1>{{{$info->title}}}</h1>
			<!-- competition banner -->
			<div class="bannercontainer" onmouseover="bannerhover()" onmouseout="bannerout()" onclick="bannerclick()">
				<div class="ui right huge corner label bannermag" id="bannermag"><i class="search icon"></i></div>
				<img class="ui image compbanner" src="{{$info->getBannerUrl()}}">
			</div>
			<!-- hidden modal -->
			<div class="ui banner modal">
				<p id="modalclose"><i class="large close icon"></i></p>
				<div id="modalbannercont"><img class="ui rounded image" src="{{$info->getBannerUrl()}}"></div>
			</div>
			<!-- competition info -->
			{{Markdown::parse(unhtmlize($info->content))}}
			
			<!-- competition info footer -->
			<div class="ui horizontal icon divider"><i class="circular heart icon"></i></div>
			<div class="compfooter left">
				@if (Auth::check())
				
				@if (Auth::user()->hasUpvoted($info->id))
				<div class="ui tiny toggle icon active button" id="upvotebutton" onclick="butupvotedown()">You Upvoted This</div>
				@else
				<div class="ui tiny toggle icon button" id="upvotebutton" onclick="butupvotedown()"><i class="star icon"></i> Upvote This!</div>
				@endif
				
				@if (Auth::user()->isFollowing($info->id))
				<div class="ui tiny toggle icon active button" id="followbutton" onclick="butfollowdown()">Following</div>
				@else
				<div class="ui tiny toggle icon button" id="followbutton" onclick="butfollowdown()"><i class="briefcase icon"></i> Follow</div>
				@endif
				
				@endif
				<p>
					<i class="users icon"></i>{{$followers_count}} users are following this competition.
					<br>
					<i class="add sign box icon"></i>{{$upvoters_count}} upvotes so far.
				</p>
			</div>
			<div class="compfooter right">
				<div id="fb-btn" class="ui tiny facebook icon button"><i class="facebook icon"></i> Facebook</div>
				<div id="tw-btn" class="ui tiny twitter icon button"><i class="twitter icon"></i> Twitter</div>
				<div id="gplus-btn" class="ui tiny google plus icon button"><i class="google plus icon"></i> Google+</div>
				<p><i class="globe icon"></i>Sharing doesn't hurt your internet quota.</p>
			</div>
		</div>

		<!-- comment section begin -->
		<div class="ui segment" id="maincomment">
			<div class="ui huge red ribbon label">Comments</div>

			<?php
				$comments = $info->comments();
			?>

			<p class="commentnumbar">Showing {{$comments->count()}} comments.
				<!-- <a href=#><i class="repeat icon"></i>Load more?</a> -->
			</p>

			@foreach ($comments->get() as $item)
			<!-- comment item -->
			<div class="ui comments">
			<div class="comment">
				<a class="avatar" id="commentavatar"><img src="{{asset('assets/img/avatars/' . $item->user()->first()->avatar_filename)}}"></a>
				<div class="content" id="commentcontent"><a class="author" id="commentauthor" href=#>{{$item->user()->first()->full_name}}</a>
				<div class="metadata"><span class="date">{{$item->getReadableDate()}}</span></div>
				<div class="text">
					{{Markdown::parse(unhtmlize($item->content))}}
				</div>
			</div></div></div>
			<div class="ui divider"></div>
			@endforeach
			
			@if (Auth::check())
			<!-- <form class="ui reply form" id="commentboxcont"> -->
			{{Form::open(['url' => URL::to('/comment/create'), 'method' => 'POST', 'class' => 'ui reply form', 'id' => 'commentboxcont'])}}
			<div id="commentuser"><i class="user icon"></i>Logged in as <b>{{Auth::user()->full_name}}</b></div>
			<div class="ui message">
				<p>Comments are rendered using <a href="http://en.wikipedia.org/wiki/Markdown">Markdown</a>. Markdown cheatsheet is provided <a href="http://warpedvisions.org/projects/markdown-cheat-sheet.md">here</a>.</p>
			</div>
			<div class="field">
				<textarea name="content" placeholder="Have something to say?"></textarea>
				<input type="hidden" name="competition_id" value="{{$info->id}}">
			</div>
			<!-- <div class="ui tiny button teal submit">Post Comment</div> -->
			<input value="Post Comment" type="submit" class="ui tiny button teal submit">
			</form>
			@else
			<div id="commentuser"><i class="user icon"></i>You must be logged in to post comment.</div>
			@endif
			
		</div>
		<!-- comment section end -->
		@include('templates.footer')
	</div>

@stop

@section('additional-assets-top')

@stop

@section('additional-assets-bottom')

<script type="text/javascript">
	
	//toggle button behavior
	function butupvotedown() {
		var obj = document.getElementById("upvotebutton");

		$.ajax({
			url: "{{ URL::to('/user/toggle-upvote') }}",
			type: 'POST',
			dataType: 'json',
			data: {'competition_id': {{$info->id}} },
		})
		.done(function(r) {
			if (!r.active) {
				obj.className = "ui tiny toggle icon button";
				obj.innerHTML = "<i class=\"star icon\"></i> Upvote This!";
			}
			else {
				obj.className = "ui tiny toggle icon active button";
				obj.innerHTML = "You Upvoted This";
			}
			console.log("success upvote");
		})
		.fail(function(r) {
			console.log("error");
		})
		.always(function(r) {
			console.log("complete");
		});

	}

	function butfollowdown() {
		var obj = document.getElementById("followbutton");

		$.ajax({
			url: "{{ URL::to('/user/toggle-following') }}",
			type: 'POST',
			dataType: 'json',
			data: {'competition_id': {{$info->id}} },
		})
		.done(function(r) {
			if (!r.active) {
				obj.className = "ui tiny toggle icon button";
				obj.innerHTML = "<i class=\"briefcase icon\"></i> Follow";
			}
			else {
				obj.className = "ui tiny toggle icon active button";
				obj.innerHTML = "Following";
			}
			console.log("success follow");
		})
		.fail(function(r) {
			console.log("error");
		})
		.always(function(r) {
			console.log("complete");
		});
	}

</script>

{{ HTML::script('assets/js/behav-content.js'); }}

@stop