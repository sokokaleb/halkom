<?php

/**
 * Main controller for the site
 *
 * This is the controller responsible for handling user queries to see pages.
 *
 * @package controllers
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class HomeController extends BaseController {

	/**
	 * Handles request to the homepage
	 *
	 * This function returns view to the homepage.
	 * @return \Illuminate\View\View Rendered view to homepage.
	 */
	public function getIndex()
	{
		return View::make('index');
	}

	/**
	 * Handles user login request
	 *
	 * This function handles POST method request to login user based on the
	 * Input user had filled.
	 * @return \Illuminate\Http\RedirectResponse
	 *         Redirects user to last page viewed.
	 *         Will also flash success message if successful, or error messages
	 *         otherwise.
	 */
	public function postLogin()
	{
		$rules =
		[
			'username' => 'required|username',
			'password' => 'required',
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::back()->withErrors($validator);
		else
		{
			// coba login
			$userdata =
			[
				'username'	=> Input::get('username'),
				'password'	=> Input::get('password'),
			];

			$remember_me = Input::has('chk_remember') ? true : false;

			if (Auth::attempt($userdata, $remember_me))
			{
				// berhasil
				
				return Redirect::to('/')
					->with('msg', 'Berhasil login!');
			}
			else
			{
				return Redirect::back()
					->with('login_error_msg', 'Kombinasi username/password salah.');
			}
		}
	}

	/**
	 * Handles user logout request
	 *
	 * This function handles GET/POST method request to logout himself/herself.
	 * 
	 * @return \Illuminate\Http\RedirectResponse
	 *         Redirects user to homepage.
	 */
	public function anyLogout()
	{
		$message = null;

		if (Auth::check())
		{
			if (Auth::logout())
				$message = 'Berhasil logout!';
			else
				$message = 'Tidak berhasil logout, coba beberapa saat lagi.';
		}

		return Redirect::to('/')
			->with('msg', $message);
	}

	/**
	 * Handles user request to registration page
	 *
	 * This function handles GET method request to view the registration page.
	 * @return \Illuminate\View\View Rendered view of registration page.
	 */
	public function getRegister()
	{
		return View::make('register');
	}

	/**
	 * Handles user request to register
	 *
	 * This function handles POST method request to make an account based on
	 * Input filled by the user.
	 * @return \Illuminate\Http\RedirectResponse
	 *         Redirects user to the latest page viewed.
	 *         Will also flash error messages if exist, or success message
	 *         otherwise.
	 */
	public function postRegister()
	{
		$rules =
		[
			'full_name'				=> 'required|alpha_num_spaces',
			'email'					=> 'required|email|unique:users,email',
			'password'				=> 'required|printable_ascii|confirmed|between:4,20',
			'password_confirmation' => 'required|printable_ascii',
			'chk_agree' 			=> 'required',
		];

		$validator = Validator::make(Input::all(),$rules);

		if ($validator->fails())
			return Redirect::back()
				->withErrors($validator)
				->withInput(Input::except(['password', 'password_confirmation']));
		else
		{
			// berhasil, yok bikin user
			
			$user = new User;

			$user->full_name = Input::get('full_name');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->email = Input::get('email');

			$user->save();

			return Redirect::to('/')
				->with('message', 'Registered successfully. You can now login with your credentials.');

		}
	}

	/**
	 * Handles user request to view competitions list
	 *
	 * This function handles GET method request to see list of competitions.
	 * @return \Illuminate\View\View
	 *         Rendered view of competitions list page.
	 *         Passes $paginator as collection of competitions that will be
	 *         showed.
	 */
	public function getCompetitions()
	{
		$items_per_page = 15;

		if (Input::has('search'))
		{
			$search = Input::get('search');
			$paginator = Competition::where('title','LIKE',"%$search%")->orderBy('id', 'desc')->paginate($items_per_page);
		}
		else $paginator = Competition::orderBy('id', 'desc')->paginate($items_per_page);

		return View::make('competition.competitions')
			->with('paginator', $paginator);
	}


	/**
	 * Handles user request to view a particular competition
	 *
	 * This function handles GET method request to a particular competition
	 * whose ID is $competition_id.
	 * @return \Illuminate\View\View
	 *         Rendered view of the competition.
	 *         Passes $competition as an Eloquent object of the competition.
	 *         Passes $upvoters_count, number of upvoters of the competition.
	 *         Passes $followers_count, number of followers of the competition.
	 */
	public function getCompetitionPage($competition_id)
	{
		if (null !== Competition::find($competition_id))
		{
			$competition = Competition::find($competition_id);
			$upvoters_count = $competition->upvoters()->count();
			$followers_count = $competition->followers()->count();
			return View::make('competition.competition-page')
				->with('info', Competition::find($competition_id))
				->with('upvoters_count', $upvoters_count)
				->with('followers_count', $followers_count);
		}
		App::abort(404);
	}

	/**
	 * Test page handler
	 */
	
	public function anyTest()
	{
		$precalc =
		[
			['user_id' => 1, 'competition_id' => 1],
			['user_id' => 1, 'competition_id' => 2],
		];

		foreach ($precalc as $item) {
			$user = User::find($item['user_id']);
			$competition = Competition::find($item['competition_id']);

			$competition->user()->associate($user);
			$competition->save();
		}

		$precalc = 
		[
			['competition_id' => 1, 'milestone_id' => 1],
			['competition_id' => 1, 'milestone_id' => 2],
			['competition_id' => 1, 'milestone_id' => 3],
			['competition_id' => 1, 'milestone_id' => 4],
		];

		foreach ($precalc as $item) {
			$competition = Competition::find($item['competition_id']);
			$milestone = Milestone::find($item['milestone_id']);

			$milestone->competition()->associate($competition);
			$milestone->save();
		}

		return View::make('test');
	}
}
