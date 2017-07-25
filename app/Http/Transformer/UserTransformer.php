<?php
	namespace App\Http\Transformer;

	use App\Models\User;
	Use League\Fractal\TransformerAbstract;

	class UserTransformer extends TransformerAbstract
	{

		function transform(User $user)
		{
			return [
				'name'		=> $user->name,
				'email'		=> $user->email,
				'api_token'	=> $user->api_token,
			];
		}
	}