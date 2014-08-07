<?php

function htmlize($item)
{
	if (!is_string($item)) return $item;
	$param = $item;
	if ($param != null)
	{
		if ( get_magic_quotes_gpc() )
			$param = htmlspecialchars( stripslashes((string)$param) );
		else
			$param = htmlspecialchars( (string)$param );
	}
	return $param;
}

function unhtmlize($item)
{
	return htmlspecialchars_decode((string)$item);
}

function phpTimeToMysql($date)
{
	return date('Y-m-d', $date);
}