<?php

/**
 * Controller for the commenting system
 *
 * This is the controller responsible for handling comment-based queries.
 *
 * @package controllers
 * @author Pusaka Kaleb Setyabudi <sokokaleb@gmail.com>
 */
class CommentController extends BaseController {

	/**
	 * Handles comment post request
	 *
	 * This function handles POST method request to post a new comment.
	 * It will redirects to the current page user is viewing.
	 * @return \Illuminate\Http\RedirectResponse Redirect user to last page viewed.
	 */
	public function postCreate()
	{
		$rules =
		[
			'content'			=>	'required',
			'competition_id'	=>	'required|numeric',
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::back()->withErrors($validator);
		else
		{
			$comment = new Comment;
			$comment->content = htmlize(Input::get('content'));
			$comment->user_id = Auth::user()->id;
			$comment->competition_id = Input::get('competition_id');

			$comment->save();
			
			return Redirect::back()->with('msg', 'Komentar berhasil dibuat.');
		}
	}

}
