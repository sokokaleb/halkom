
		<!-- general message start -->
		@if (isset($errors) && $errors->count() > 0)
		<div class="ui closable error message" id="generalmsg">
			<i class="close icon"></i>
			<div class="header">Some errors encountered!</div>
			<ul class="ui list">
				@foreach ($errors->all() as $item)
					<li>{{$item}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<!-- general message end -->