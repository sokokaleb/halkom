<?php

/**
 * Model representating comments
 *
 * This model extends Eloquent ORM for ActiveRecord implementation.
 *
 * @package models
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class Comment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * Relationship definition between Comment and Competition
	 *
	 * A Comment belongs to a Competition (page).
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Competition(s) that has this Comment.
	 */
	public function competition()
	{
		return $this->belongsTo('Competition');
	}

	/**
	 * Relationship definition between Comment and User
	 *
	 * A Comment belongs to a User. User posted a single Comment.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of User that posted this Comment.
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Returns a human-readable time format of this Comment's post time.
	 *
	 * This function will parse this Comment's post time, and returns it in a
	 * human-readable format. The time format will parsed based on current time.
	 * 
	 * If the comment is posted under one minute ago, "just now" will be returned.
	 * If the comment is posted under one hour ago, "x minutes ago" will be
	 * returned, where x is the minute difference.
	 * If the comment is posted under 24 hours ago, "x hours ago" will be
	 * returned, where x is the hour difference.
	 * If the comment is posted on the day before and over 24 hours, "yesterday"
	 * will be returned.
	 * If the comment is posted under a week ago, "x days ago" will be returned,
	 * where x is the day difference.
	 * Otherwise, returns the exact date of posting.
	 * 
	 * @return string Human-readable date format of the comment's posting time.
	 */
	public function getReadableDate()
	{
		$date = strtotime($this->created_at);
		$time = time();

		if ($date > $time - 60)
			return "just now";

		for ($i = 1; $i <= 59; ++$i)
			if ($date >= $time - $i * 60)
				return $i . " minute" . ($i === 1 ? "s" : "") . " ago";

		for ($i = 1; $i < 24; ++$i)
			if ($date >= $time - $i * 60 * 60)
				return $i . " hour" . ($i === 1 ? "s" : "") . " ago";

		$time_coded = strtotime(date('Y-m-d', $time));

		if ($date >= $time_coded - 86400)
			return "yesterday";

		for ($i = 2; $i < 7; ++$i)
			if ($date >= $time_coded - 86400 * $i)
				return $i . " days ago";

		return date('j F Y', $date);
	}

}
