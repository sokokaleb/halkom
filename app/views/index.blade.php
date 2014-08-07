@extends('templates.default', ['title' => 'Halaman Kompetisi - Fasilkom UI'])

@section('main-content')

	<div class="column" id="contentbar">
		<!-- homepage slider begin -->
		<div class="imageslidercont">
      <ul class="rslides" id="imageslider">
        <li><a href="content.html"><img src="{{asset('assets/img/banner.jpg')}}"></a><div class="caption">Lomba Cipika-Cipikian</div></li>
        <li><a href="content.html"><img src="{{asset('assets/img/banner2.jpg')}}" alt=""></a><p class="caption">Ini contoh kalo pake caption sih</p></li>
        <li><a href="content.html"><img src="{{asset('assets/img/banner3.jpg')}}"></a></li>
				<li><a href="content.html"><img src="{{asset('assets/img/banner.jpg')}}"></a></li>
				<li><a href="content.html"><img src="{{asset('assets/img/banner2.jpg')}}"></a></li>
        <li><a href="content.html"><img src="{{asset('assets/img/banner3.jpg')}}"></a></li>
      </ul>
    </div>
		<div class="imagesliderbleed">&nbsp;</div>
		<!-- homepage slider end -->
		<div class="ui segment">
			<h2 class="content">Welcome!</h2>
			<p>You might be wondering what this site is for. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce viverra ipsum tellus, vel lacinia quam molestie eu. Integer eget elementum mauris, in malesuada nunc. Nullam tincidunt nulla vitae elit pellentesque dignissim. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent tincidunt volutpat ipsum non blandit. Cras ullamcorper vestibulum turpis, et aliquam odio facilisis quis. Curabitur ut lacus accumsan, vestibulum ligula a, condimentum augue. Maecenas eget ullamcorper metus.</p>
			<p>Morbi sed vestibulum leo, vitae sagittis orci. Phasellus vehicula ligula eu sem ullamcorper vulputate. Vivamus varius urna erat, a placerat dolor egestas ac. Etiam lobortis lacus sem, et condimentum erat suscipit non. Sed lacinia ante lorem, at laoreet eros aliquam nec. Fusce viverra tincidunt purus sed rhoncus. Fusce ultricies quis metus eu malesuada.</p>
			<p>Morbi ac accumsan justo. Sed lorem libero, gravida quis odio at, laoreet viverra lorem. Phasellus nec neque consectetur, porta lorem mollis, commodo metus. Phasellus mi lectus, bibendum quis tempor in, dapibus vel quam. Proin faucibus consequat ullamcorper. Nunc ante purus, volutpat et sapien sed, lobortis fringilla mi. Aliquam eleifend nisl in urna lacinia, sed cursus mi adipiscing. Aliquam erat volutpat. Nullam tristique erat vitae rhoncus facilisis. Quisque egestas quis orci sit amet egestas.</p>
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