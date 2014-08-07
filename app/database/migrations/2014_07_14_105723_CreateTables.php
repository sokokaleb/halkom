<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Creating tables in the database
 *
 * This class will be called under `php artisan migrate` command.
 *
 * @package migrations
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */

class CreateTables extends Migration {

	/**
	 * Run the migrations
	 *
	 * This function will make the tables required for this application.
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = "InnoDB";

			$table->increments('id');

			$table->string('full_name');
			$table->string('username')->unique();
			$table->string('password');
			$table->string('email')->unique();
			$table->string('user_level')->default('normal'); // {admin|normal}
			$table->string('avatar_filename')->default('avatar.jpg'); // username.ext, 100 px x 100 px
			$table->string('remember_token');	
			$table->timestamps();

			$table->index('full_name');
			$table->index('username');
		});

		Schema::create('competitions', function(Blueprint $table)
		{
			$table->engine = "InnoDB";

			$table->increments('id');

			$table->string('title');
			$table->date('end_date');
			$table->text('description');
			$table->text('content');
			$table->string('banner_filename')->default('competition_banner.png');
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->index('title');
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade')->onUpdate('cascade');
		});

		Schema::create('milestones', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments('id');

			$table->string('description');
			$table->date('execution_date');
			$table->integer('competition_id')->unsigned();

			$table->index('competition_id');
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('cascade')->onUpdate('cascade');
		});

		Schema::create('comments', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->increments('id');

			$table->text('content'); // markdown

			$table->integer('user_id')->unsigned();
			$table->integer('competition_id')->unsigned();
			$table->timestamps();

			$table->index('user_id');
			$table->index('competition_id');
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('cascade')->onUpdate('cascade');
		});

		// Pivots		
		Schema::create('followings', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->integer('user_id')->unsigned();
			$table->integer('competition_id')->unsigned();
		
			$table->index('user_id');
			$table->index('competition_id');
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('cascade')->onUpdate('cascade');
		});
		
		Schema::create('upvotes', function(Blueprint $table)
		{
			$table->engine = "InnoDB";
			$table->integer('user_id')->unsigned();
			$table->integer('competition_id')->unsigned();
		
			$table->index('user_id');
			$table->index('competition_id');
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('competition_id')->references('id')->on('competitions')
				->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Pivots
		Schema::dropIfExists('followings');
		Schema::dropIfExists('upvotes');

		Schema::dropIfExists('comments');
		Schema::dropIfExists('milestones');
		Schema::dropIfExists('competitions');
		Schema::dropIfExists('users');
	}
}
