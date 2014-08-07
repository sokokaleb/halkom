<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}
}

/**
 * Class for seeding the users table
 */
class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		DB::table('users')->insert(
			[
				'full_name' 	=>	'Pusaka Kaleb Setyabudi',
				'username'		=>	'admin',
				'password'		=>	Hash::make('admin'),
				'email'			=>	'sokokaleb@gmail.com',
				'user_level'	=>	'admin',
			]
		);
		
	}

}