<!doctype html>
<html>

<head>
	<!-- Standard Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>{{{$title}}}</title>
	<!-- linking CSS -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Merriweather:700italic' rel='stylesheet' type='text/css'>
	{{ HTML::style('assets/semantic/packaged/css/semantic.min.css') }}

	@yield('additional-assets-top')
	{{ HTML::style('assets/css/stylemain.css') }}
</head>

<body>

<!-- navigation bar -->
@include('templates.header')

<!-- main stage -->
<div class="two column stackable ui grid" id="mainstage">

	<!-- sidebar -->
	@include('templates.sidebar')

	<!-- main content -->
	@yield('main-content')
</div>	
	
<!-- initialize behaviors -->

{{ HTML::script('assets/js/jquery-2.1.1.min.js') }}
{{ HTML::script('assets/semantic/packaged/javascript/semantic.min.js') }}

{{ HTML::script('assets/js/behav-main.js') }}
{{ HTML::script('assets/js/behav-sidebar.js') }}

@yield('additional-assets-bottom')

</body>
</html>