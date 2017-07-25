<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests\MeRequest;
use App\Http\Transformer\UserTransformer;
use App\Models\User;
use App\Repositories\UsersRepository;


class UserController extends Controller
{
	public function __construct(UsersRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Update the specified user logged.
	 *
	 * @param  collection $request
	 * @return \Illuminate\Http\Response
	 */
	public function me(MeRequest $request)
	{
		$user = Auth::user();
		$user = $this->repository->update(
			$user,
			$request->name,
			$request->email
		);
		return fractal($user, new UserTransformer());
	}
}
