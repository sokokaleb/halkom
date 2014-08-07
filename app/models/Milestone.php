<?php

/**
 * Model representating milestones whose competition submitted on this app
 *
 * This model extends Eloquent ORM for ActiveRecord implementation.
 *
 * @package models
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class Milestone extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'milestones';


	/**
	 * Indicates if the model shouldn't be timestamped.
	 *
	 * @var boolean
	 */
	protected $timestamps = false;

	/**
	 * Relationship definition between Milestone and Competition
	 *
	 * A Milestone belongs to a Competition
	 * @return \Illuminate\Database\Eloquent\Collection
	 *         A collection of Competitions that have this Milestone.
	 */
	public function competition()
	{
		return $this->belongsTo('Competition');
	}
}