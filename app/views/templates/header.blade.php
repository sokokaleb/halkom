<div class="ui inverted menu" id="navbar">
	{{ HTML::link('/', 'Halaman Kompetisi', ['class' => 'item disabled sitetitle']) }}
	<!-- link section -->
	<span class="sitenavshow sitenavlink">
		<a class="{{(Request::is('/') ? 'active ' : '') . 'item'}}" href="{{URL::to('/')}}">
			<i class="home icon"></i> Home
		</a>
		<a class="{{(Request::is('/competitions') ? 'active ' : '') . 'item'}}" href="{{URL::to('/competitions')}}">
			<i class="trophy icon"></i> Competitions
		</a>
		<!--
		<a class="{{(Request::is('/discussions') ? 'active ' : '') . 'item'}}" href=#>
			<i class="chat icon"></i> Discussions
		</a>
		-->
	</span>
	<!-- searchbar section -->
	<!--
	<span class="sitenavshow sitenavsearch">
		<div class="right item">
			<div class="ui icon input"> 
				<input placeholder="Search..." type="text">
				<i class="search link icon"></i>
			</div>
		</div>
	</span>
	-->
	<!-- hidden button section -->
	<span class="sitenavhidden">
		<div class="ui simple dropdown item"><i class="reorder icon"></i>MENU
    <div class="menu">
      <a href="{{URL::to('/')}}"><div class="item">Home</div></a>
      <a href="{{URL::to('/competitions')}}"><div class="item">Competition</div></a>
      <a href="#"><div class="item">Discussion</div></a>
    </div></div>
	</span>
</div>