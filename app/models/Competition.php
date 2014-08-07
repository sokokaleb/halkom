<?php

/**
 * Model representating competitions submitted on this app
 *
 * This model extends Eloquent ORM for ActiveRecord implementation.
 *
 * @package models
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class Competition extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'competitions';

	/**
	 * Relationship definition between Competition and User
	 *
	 * A Competition belongs to (made by) a single User.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of User that made this Competition.
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Relationship definition between Competition and Milestone
	 *
	 * A Competition has many Milestones.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Milestone of this Competition.
	 */
	public function milestones()
	{
		return $this->hasMany('Milestone');
	}

	/**
	 * Relationship definition between Competition and Users who follow this
	 * Competition
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of User that follows this Competition.
	 */
	public function followers()
	{
		return $this->belongsToMany('User', 'followings');
	}

	/**
	 * Relationship definition between Competition and Users who upvote this
	 * Competition
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of User that upvotes this Competition.
	 */
	public function upvoters()
	{
		return $this->belongsToMany('User', 'upvotes');
	}

	/**
	 * Relationship definition between Competition and Comment
	 *
	 * A Competition has many Comments.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Comment of this Competition.
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/**
	 * Returns the URL address of the page of this Competition
	 *
	 * This function returns the URL address of the page of this Competition.
	 * @return string The URL address.
	 */
	public function getUrl()
	{
		return URL::to('competition/' . $this->id);
	}

	/**
	 * Returns the URL address of the banner image of this Competition
	 *
	 * This function returns the URL address of the banner image of this
	 * Competition.
	 * @return string The URL address.
	 */
	public function getBannerUrl()
	{
		return asset('assets/img/competition_banner/' . $this->banner_filename);
	}

	// /**
	//  * Time getter
	//  */
	// public function getEndDateAttributes()
	// {
	// 	return $this->end_date;
	// }

	// public function getEndTime()
	// {
	// 	return strtotime($this->getEndDateAttributes());
	// }

	/**
	 * Returns Eloquent collection of top competition.
	 *
	 * This static function returns an Eloquent collection of the top
	 * $top_competition competition.
	 * A competition is categorized as a top competition based on its end date
	 * (should not have ended), most number of upvotes, then the most number
	 * of comments.
	 *
	 * @param int $top_competition
	 *        Maximum number of competition returned in the collection.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of top competitions.
	 */
	static function getTopCompetition($top_competition = 3)
	{
		$ret = Competition::where('end_date', '>=', phpTimeToMysql(time()))->get()
			->sortBy(function ($item) {
					return [$item->upvoters()->count(), $item->comments()->count()];
				})
			->reverse()->take($top_competition);

		return $ret;
	}
}