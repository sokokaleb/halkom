
	<div class="four wide column" id="sidebar">
	
	<div class="ui fluid segment">
		@if (Auth::check())

		<!-- userprofile start -->
		<div class="ui large top attached purple label">Your Account</div>
		<div id="userprofile">
			<!-- details section -->
			<div class="detailscont">
				<div class="avatarcont">
					<!-- TODO: Yo Ganti Avatar -->
					<img src="{{asset('assets/img/avatars/' . Auth::user()->avatar_filename)}}" class="avatar">
				</div>
				<div class="namecont">
					<div class="username">{{ Auth::user()->username }}</div>
					<div class="handlename">{{ Auth::user()->full_name }}</div>
				</div>
			</div>
			<!-- menu section -->
			<?php
				$menu_class = 'teal item';
			?>
			<div class="ui vertical menu">
				<a href="{{URL::to('/user/submit-new-competition')}}" class="{{$menu_class}}">Submit New Competition</a>
				<a href="{{URL::to('/user/my-submitted-competitions')}}" class="{{(Request::is('user/my-submitted-competitions*') ? 'active ' : '') . $menu_class}}">My Submitted Competitions</a>
			</div>
			@if (Auth::user()->user_level === 'admin')
			<div class="ui vertical menu">
				<a href="{{URL::to('/admin/competition-list')}}" class="{{(Request::is('admin/competition-list*') ? 'active ' : '')}}red item">Review Submissions<div class="ui red label">pdg cnt</div></a>
				<a href="{{URL::to('/admin/manage-homepage')}}" class="{{(Request::is('admin/manage-homepage*') ? 'active ' : '')}}red item">Manage Homepage</a>
			</div>
			@endif
			<div class="ui vertical menu">
				<!-- <a href=# class="{{(Request::is('user/my-messages*') ? 'active ' : '') . $menu_class}}">Messages<div class="ui teal label"><i class="mail outline icon"></i> 1</div></a> -->
				<a href="{{URL::to('/user/my-milestones')}}" class="{{(Request::is('user/my-milestones*') ? 'active ' : '') . $menu_class}}">My Milestones</a>
				<a href="{{URL::to('/user/my-followed-competitions')}}" class="{{(Request::is('user/my-followed-competitions*') ? 'active ' : '') . $menu_class}}">Followed Competitions</a>
				<a href="{{URL::to('/user/settings')}}" class="{{(Request::is('user/settings*') ? 'active ' : '') . $menu_class}}">Account Settings</a>
			</div>
			<!-- logout section -->
			<div style="padding-left: 10px;">
				<a href="{{URL::to('/logout')}}"><div class="ui tiny teal button">Logout</div></a>
			</div>
		</div>
		<!-- userprofile end -->

		@else

		<div class="ui large top attached purple label">User Login</div>
			<!-- login form start -->
			@if (Session::has('login_error_msg'))
				<div class="ui small error message">{{Session::get('login_error_msg')}}</div>
			@endif
			<!-- <form method="POST" action="catch.php"><div class="ui form"> -->
			{{ Form::open(['url' => URL::to('/login'), 'method' => 'post']) }}
			<div class="ui form">
				<div class="field">
					<label>Username</label>
					<div class="ui small left labeled icon input">
					<input name="username" placeholder="Username" type="text">
					<i class="user icon"></i></div>
				</div>
				<div class="field">
					<label>Password</label>
					<div class="ui small left labeled icon input">
					<input name="password" placeholder="Password" type="password">
					<i class="lock icon"></i></div>
				</div>
				<div style="padding-left: 10px;">
					<div class="ui checkbox field">
						<input name="chk_remember" id="chk_remember" type="checkbox">
						<label for="chk_remember">Remember me</label>
					</div><br>
					<input value="Login" type="submit" class="ui tiny teal button">
					<a href="{{ URL::to('/register') }}"><div class="ui tiny button">Register</div></a>
				</div>
			</div>
			{{ Form::close() }}
			<!-- </div></form> -->
			<!-- login form end -->

		@endif
	</div>
	
		<div class="ui segment">
			<!-- milestone start -->
			<div class="ui large ribbon purple label">Milestones</div>
			<p></p>
			<div style="text-align: center;">
			<div class="ui icon buttons" id="calendarselect">
			  <div class="ui small button"><i class="left arrow icon"></i></div>
				<div id="milestone-dp" class="ui small button" style="min-width:160px;" data-variation="small">July 2014</div>
				<div class="ui small button"><i class="right arrow icon"></i></div>
			</div></div>
			
			<table id="milecalendar">

				<?php

					$curdate	= 1;
					$curmon		= date('n', time());
					$curyr		= date('Y', time());
					$curday 	= date('w', strtotime($curdate.'-'.$curmon.'-'.$curyr));
					$currow 	= 0;
					$nrday 		= cal_days_in_month(CAL_GREGORIAN, date('n', time()), date('Y', time()));
					$dayprinted	= -$curday;

					// echo $nrday . ' ' . $curday . ' ' . $curdate.'-'.$curmon.'-'.$curyr . ' ';

					$comp = Milestone::where('execution_date', date('Y-m-d', strtotime($curdate.'-'.$curmon.'-'.$curyr)))->count();

					// var_dump($comp);
				?>

				<thead><tr><th class="r">S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th class="b">S</th></thead>
				<tbody>
					<!-- td.td for today, div.ev for event -->

					<?php

					echo '<tr>';
					for (; $dayprinted < 0; ++$dayprinted)
						echo '<td>&nbsp;</td>';

					for (; $dayprinted < $nrday; ++$dayprinted, ++$curdate, ++$curday)
					{
						while ($curday >= 7)
						{
							$curday -= 7;
							echo '</tr><tr>';
						}

						$tdclass = '';
						if ($curday == 0) $tdclass .= 'r ';
						if ($curday == 6) $tdclass .= 'b ';
						if (date('Y-m-d', strtotime($curdate.'-'.$curmon.'-'.$curyr)) === date('Y-m-d', time()))
							$tdclass .= 'td ';

						$tdclass = trim($tdclass, ' ');

						if (Milestone::where('execution_date', date('Y-m-d', strtotime($curdate.'-'.$curmon.'-'.$curyr)))->count() > 0)
							echo '<td class="' . $tdclass . '"><div class="ev">' . $curdate . '</div></td>';
						else
							echo '<td class="' . $tdclass . '">' . $curdate . '</td>';
					}

					for (; $curday < 7; ++$curday)
						echo '<td>&nbsp;</td>';

					echo '</tr>';

					?>
				</tbody>
			</table>
			<table id="milecalendarinfo">
				<?php

				$curdate	= 1;
				$curmon		= date('n', time());
				$curyr		= date('Y', time());

				$nowdate = strtotime($curdate.'-'.$curmon.'-'.$curyr);
				$nextdate = strtotime('+1 month ' . $curdate.'-'.$curmon.'-'.$curyr);

				$nrday 		= cal_days_in_month(CAL_GREGORIAN, date('n', time()), date('Y', time()));

				$infos = Milestone::where('execution_date','>=', date('Y-m-d', $nowdate))
							->where('execution_date', '<', date('Y-m-d', $nextdate))
							->orderBy('execution_date');

				if ($infos->count() > 0)
				{
					$infos = $infos->get();
					foreach ($infos as $item)
					{
						$evdate = date('j', strtotime($item->execution_date));
						echo '<tr><th>' . $evdate . '</th><td><div><strong>' . $item->competition()->first()->title . '</strong><br>' . $item->description . '</div></td></tr>';
					}
				}

				?>

			</table>
			<!-- milestone end -->

			@if (Auth::check())
			
			<!-- Followed Competitions starts here -->

			<?php

				$followed_item = Auth::user()->followings()->get();

			?>

			<div class="ui large ribbon purple label">Competitions Followed</div>

			<div class="ui divided list" id="sidefeed">

				@if ($followed_item->count() === 0)
				<p>Tidak ada kompetisi yang diikuti.</p>
				@else
				@foreach ($followed_item as $item)
				<div class="item">
					<i class="trophy icon"></i>
					<div class="content">
					<a href=#><span class="header">{{$item->title}}</span>
					<div class="description"><i>{{$item->description}}</i></div></a></div>
				</div>
				@endforeach
				@endif
				
			</div>

			@endif
			
			<!-- hottest trends start -->

			<?php

				$top_item = Competition::getTopCompetition();

			?>

			<div class="ui large ribbon purple label">Hottest Competitions</div>
			<div class="ui divided list" id="sidefeed">

				@foreach ($top_item as $item)
				<!-- an item -->
				<div class="item">
					<i class="right arrow icon"></i>
					<div class="content"><a href="{{$item->getUrl()}}">
						<span class="header">{{$item->title}}</span>
						<div class="description"><i>{{$item->description}}</i></div>
						<div class="details"><i class="add sign box icon"></i>{{$item->upvoters()->count()}} upvotes&nbsp;&nbsp;<i class="comment icon"></i>{{$item->comments()->count()}} comment{{($item->comments()->count() > 1 ? 's' : '')}}</div>
					</a></div>
				</div>
				@endforeach

			</div>
			<!-- hottest trends end -->

		</div>
	</div>