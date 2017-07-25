<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;

use App\Models\User;

class UsersRepository
{
	public function create($data)
	{
		return User::create([
			'name' 		=> $data['name'],
			'email' 	=> $data['email'],
			'api_token' => str_random(60),
			'password' 	=> bcrypt($data['password']),
		]);
	}

	public function update($user, $name, $email)
	{
		$user = User::find($user->id);
		$user->name = $name ? $name : $user->name;
		$user->email = $email ? $email : $user->email;
		$user->save();

		return $user;
	}
}