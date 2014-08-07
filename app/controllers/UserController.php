<?php

/**
 * Main controller for user specific menus
 *
 * This is the controller responsible for handling user queries that is related
 * to user specific menus (/user).
 *
 * @package controllers
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class UserController extends BaseController {

	/**
	 * Constructor for this controller
	 *
	 * This function limits the accessibility of this controller.
	 * This controller can only be accessed by authenticated user.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
	}

	/**
	 * Handles request to the user account settings
	 *
	 * This function returns view to the user account settings page.
	 * @return \Illuminate\View\View Rendered view to user account settings page.
	 */
	public function getSettings()
	{
		return View::make('user.settings');
	}
	
	/**
	 * Handles request to update the user's account information
	 *
	 * This function updates the user information based on the Input filled by
	 * the current authenticated user.
	 * @return \Illuminate\Http\RedirectResponse
	 *         Redirects user to the last page viewed.
	 *         Will also flash error messages if exist, or success message
	 *         otherwise.
	 */
	public function postUpdateProfile()
	{
		$user = User::find(Auth::user()->id);
		$validator = null;
		$rules =
		[
			'full_name'		=> 'required|alpha_num_spaces',
			'email'			=> 'required|email|unique:users,email,' . Auth::user()->id,
			'avatar'		=> 'image|image_size:100,100|max:100',
			'old_password'	=> 'printable_ascii',
			'password'		=> 'required_with:old_password|printable_ascii|confirmed|between:4,20',
			'password_confirmation' => 'required_with:old_password|printable_ascii',
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::back()->withErrors($validator);
		else
		{
			// Update infos
			
			// Section 1: Full name and email
			$user->full_name = Input::get('full_name');
			$user->email = Input::get('email');
			// End of Section 1

			// Section 2: Avatar
			
			if (Input::hasFile('avatar'))
			{
				$file = Input::file('avatar');

				$destinationPath    = 'assets/img/avatars/'; // The destination were you store the image.
				$mime_type          = $file->getMimeType(); // Gets this example image/png
				$extension          = $file->getClientOriginalExtension(); // The original extension that the user used example .jpg or .png.

				$filename = implode('.', [$user->username, $extension]);

				$upload_res = $file->move($destinationPath, $filename); // moved!
				chmod($upload_res->getRealPath(), 0777);

				// ganti avatar filename
				$user->avatar_filename = $filename;
			}

			// End of Section 2

			// Section 3: Change Password
			
			if (Input::has('old_password') && strlen(Input::get('old_password')) > 0)
				$user->password =  Hash::make(Input::get('password'));

			// End of Section 3


			// END SAVE INFO!

			$user->save();

			return Redirect::back()
				->with('msg', 'User info updated successfully.');
		}
	}

	/**
	 * Handles request to toggle following status
	 *
	 * This function updates the authenticated user's following status of a
	 * competition whose id is Input['competition_id'].
	 * @return mixed JSON containing information of latest following status.
	 */
	public function postToggleFollowing()
	{
		$user = Auth::user();
		$competition = Competition::find(Input::get('competition_id'));

		if (null !== $user->followings()->find($competition->id)) // ada, switch off
		{
			$user->followings()->detach($competition);
			return Response::json(['active' => false]);
		}
		else
		{
			$user->followings()->attach($competition->id);
			return Response::json(['active' => true]);
		}
	}
	
	/**
	 * Handles request to toggle upvoting status
	 *
	 * This function updates the authenticated user's upvoting status of a
	 * competition whose id is Input['competition_id'].
	 * @return mixed JSON containing information of latest following status.
	 */
	public function postToggleUpvote()
	{
		$user = Auth::user();
		$competition = Competition::find(Input::get('competition_id'));

		if (null !== $user->upvotes()->find($competition->id)) // ada, switch off
		{
			$user->upvotes()->detach($competition);
			return Response::json(['active' => false]);
		}
		else
		{
			$user->upvotes()->attach($competition->id);
			return Response::json(['active' => true]);
		}
	}

	/**
	 * Handles request to view the submit new competition page
	 *
	 * This function returns view to the submit new competition page.
	 * @return \Illuminate\View\View Rendered view to submit new competition page.
	 */
	public function getSubmitNewCompetition()
	{
		return View::make('competition.new-competition');
	}
	
	/**
	 * Handles request to submit data about a new competition
	 *
	 * This function handles POST method request to make a new competition entry
	 * based on the Input user had filled.
	 * @return \Illuminate\Http\RedirectResponse
	 *         Redirects user to last page viewed.
	 *         Will also flash success message if successful, or error messages
	 *         otherwise.
	 */
	public function postSubmitNewCompetition()
	{
		$rules =
		[
			'title'			=>	'required',
			'description'	=>	'required|max:140',
			'end_date'		=>	'required|after:' . date('d M Y', time()),
			'banner'	=>	'image',
			'content'		=>	'required',
			'user_id'		=>	'required|integer',
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::back()->withErrors($validator)->withInput(Input::all());

		$competition = new Competition;

		$competition->title = htmlize(Input::get('title'));
		$competition->description = htmlize(Input::get('description'));
		$competition->end_date = phpTimeToMysql(strtotime(Input::get('end_date')));
		$competition->content = htmlize(Input::get('content'));
		$competition->user_id = Input::get('user_id');

		$competition->save();

		// Upload banner
		if (Input::hasFile('banner'))
		{
			$file = Input::file('banner');

			$destinationPath    = 'assets/img/competition_banner/'; // The destination were you store the image.
			$mime_type          = $file->getMimeType(); // Gets this example image/png
			$extension          = $file->getClientOriginalExtension(); // The original extension that the user used example .jpg or .png.

			$filename = implode('-',['banner',$competition->id . '.' . $extension]);

			$upload_success     = $file->move($destinationPath, $filename); // Now we move the file to its new home.

			chmod($upload_success->getRealPath(), 0777);

			$competition->banner_filename = $filename;
			$competition->save();
		}

		if (Input::has('milestones') && strlen(Input::get('milestones')) > 0)
		{
			$milestones = Input::get('milestones');
			$milestones = str_replace("\n\r", "\n", $milestones);
			$milestones = explode("\n", $milestones);

			foreach ($milestones as $item)
			{
				$datepos = strpos($item, ":");
				
				if (false === $datepos) continue;

				$date = substr($item, 0, $datepos);
				$date = explode("-", $date);
				$description = substr($item, $datepos + 1);

				$milestone = new Milestone;
				$milestone->description = $description;
				$milestone->execution_date = phpTimeToMysql(strtotime($date[2] . '-' . $date[1] . '-' . $date[0]));
				$milestone->competition_id = $competition->id;

				$milestone->save();
			}
		}

		return Redirect::to('/user/settings')
			->with('msg', 'Competition created successfully.');
	}
}
