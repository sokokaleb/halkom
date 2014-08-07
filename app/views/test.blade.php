@extends('templates.default', ['title' => 'Test Page'])

@section('main-content')

	<div class="column" id="contentbar">
		<div class="ui segment">
			<h2 class="content">Test-Page</h2>
			<pre>
<?php

$competition = Competition::find(1);
// echo var_dump($competition->user()->first());
echo var_dump($competition->milestones()->get());

?>
			</pre>
		</div>
		@include('templates.footer')
	</div>

@stop

@section('additional-assets-top')

@stop

@section('additional-assets-bottom')

@stop