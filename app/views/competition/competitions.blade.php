@extends('templates.default', ['title' => 'Daftar Kompetisi'])

@section('main-content')

	<div class="column" id="contentbar">
		<!-- search bar -->
		<!-- <form action="catch.html" method="GET"> -->
		{{ Form::open(['url' => URL::current(), 'method' => 'get', 'name' => 'c_form']) }}
		<div class="ui fluid action input">
			<input name="search" placeholder="Browse Competitions..." type="text" value="{{Input::has('search') ? Input::get('search') : ''}}">
			<div id="submit-btn" class="ui button">Search</div>
		</div>
		{{ Form::close() }}
		<!-- </form> -->
		
		<div class="ui divider"></div>
		
		<div class="headstat">
			@if ($paginator->getTotal() > 0)
			Showing {{ $paginator->getTotal() }} competitions{{(isset($_GET['search']) && null !== $_GET['search'] && strlen($_GET['search']) > 0 ? ' of ' . DB::table('competitions')->count() . ' competitions filtered with title "' . $_GET['search'] . '"' : '') . '.'}}
			@else
			No competitions found{{(isset($_GET['search']) && null !== $_GET['search'] && strlen($_GET['search']) > 0 ? ' with title containing "' . $_GET['search'] . '"' : '') . '.'}}
			@endif
		</div>
		
		<!-- selection cards -->
		<div class="ui three items">
			@foreach ($paginator as $item)

			<a href="{{$item->getUrl()}}"><div class="card item">
				<div class="image"><img src="{{$item->getBannerUrl()}}"></div>
				<div class="content">
					<div class="name">{{$item->title}}</div>
					<p class="description">{{$item->description}}</p>
				</div>
				<div class="status">
					<i class="star icon"></i>&nbsp;{{$item->upvoters()->count()}}&nbsp;
					<i class="users icon"></i>{{$item->followers()->count()}}&nbsp;
					<i class="comment icon"></i>{{$item->comments()->count()}}&nbsp;
					@if (time() > $item->getEndTime())
					<div class="ended tag">ENDED</div>
					@endif
				</div>
			</div></a>

			@endforeach
		</div>
		
		<!-- page toggle -->
		{{ $paginator->links() }}

		@include('templates.footer')
	</div>

@stop

@section('additional-assets-top')

@stop

@section('additional-assets-bottom')

{{ HTML::script('assets/js/behav-main.js'); }}
{{ HTML::script('assets/js/behav-competitions.js'); }}

@stop