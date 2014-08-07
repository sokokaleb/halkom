@if ($paginator->getLastPage() > 1)
	<?php
		$firstPage = 1;
		$lastPage = $paginator->getLastPage();

		$previousPage = ($paginator->getCurrentPage() > $firstPage) ? $paginator->getCurrentPage() - 1 : $firstPage;
		$nextPage = ($paginator->getCurrentPage() < $paginator->getLastPage()) ? $paginator->getCurrentPage() + 1 : $lastPage;

		$get_param = 'search=';
		if (isset($_GET['search']))
			$get_param .= $_GET['search'];
	?>  

	<center>
		<span class="ui small icon buttons">
			<a href="{{ $paginator->getUrl($firstPage) . '&' . $get_param }}"><div class="ui button{{ ($paginator->getCurrentPage() == $firstPage) ? ' disabled' : '' }}"><i class="left arrow icon"></i><i class="left arrow icon"></i></div></a>
			<a href="{{ $paginator->getUrl($previousPage) . '&' . $get_param }}"><div class="ui button{{ ($paginator->getCurrentPage() == $firstPage) ? ' disabled' : '' }}">&nbsp;<i class="left arrow icon">&nbsp;</i></div></a>
		</span>
		<span class="ui small icon buttons">
			@for ($i = 1; $i <= $paginator->getLastPage(); ++$i)
			<a href="{{ $paginator->getUrl($i) . '&' . $get_param }}"><div class="ui{{ ($paginator->getCurrentPage() == $i) ? ' active' : '' }} button">&nbsp;{{$i}}&nbsp;</div></a>
			@endfor
			<!-- <a href=#2><div class="ui button">&nbsp;2&nbsp;</div></a> -->
			<!-- <a href=#3><div class="ui button">&nbsp;3&nbsp;</div></a> -->
			<!-- <a href=#4><div class="ui button">&nbsp;4&nbsp;</div></a> -->
			<!-- <a href=#5><div class="ui button">&nbsp;5&nbsp;</div></a> -->
		</span>
		<span class="ui small icon buttons">
			<a href="{{ $paginator->getUrl($nextPage) . '&' . $get_param }}"><div class="ui button{{ ($paginator->getCurrentPage() == $lastPage) ? ' disabled' : '' }}">&nbsp;<i class="right arrow icon">&nbsp;</i></div></a>
			<a href="{{ $paginator->getUrl($lastPage) . '&' . $get_param }}"><div class="ui button{{ ($paginator->getCurrentPage() == $lastPage) ? ' disabled' : '' }}"><i class="right arrow icon"></i><i class="right arrow icon"></i></div></a>
		</span>
	</center>

@endif