<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}
	
	/**
	 * Relationship definition between User and Competition
	 *
	 * A User has many Competition.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Competition made by this User.
	 */
	public function competitions()
	{
		return $this->hasMany('Competition');
	}

	/**
	 * Relationship definition between User and Competition which is followed
	 * by User
	 *
	 * A User follows many Competition.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Competition followed by this User.
	 */
	public function followings()
	{
		return $this->belongsToMany('Competition', 'followings');
	}

	/**
	 * Relationship definition between User and Competition which is upvoted
	 * by User
	 *
	 * A User upvotes many Competition.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Competition upvoted by this User.
	 */
	public function upvotes()
	{
		return $this->belongsToMany('Competition', 'upvotes');
	}

	/**
	 * Relationship definition between User and Comment
	 *
	 * A User has many Comments.
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Comment made by this User.
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}
	
	/**
	 * Returns state whether the User followed the specific Competition
	 *
	 * This function returns true if User followed Competition whose ID is
	 * $competition_id. Returns false otherwise.
	 * @param  int  $competition_id ID of the Competition.
	 * @return boolean     State of following.
	 */
	public function isFollowing($competition_id)
	{
		return null !== $this->followings()->get()->find($competition_id);
	}

	/**
	 * Returns state whether the User upvoted the specific Competition
	 *
	 * This function returns true if User upvoted Competition whose ID is
	 * $competition_id. Returns false otherwise.
	 * @param  int  $competition_id ID of the Competition.
	 * @return boolean     State of upvoting.
	 */
	public function hasUpvoted($competition_id)
	{
		return null !== $this->upvotes()->get()->find($competition_id);
	}

}
