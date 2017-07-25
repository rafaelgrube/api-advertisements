<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use Auth;

use App\Models\Advertisement;
use App\Models\Picture;

class PicturesRepository
{
	public function findByPath($file)
	{
		return Picture::where('file', $file)->first();
	}

	public function create($advertisement_id, $file)
	{
		$file = Picture::create([
			'advertisement_id' 	=> $advertisement_id,
			'file'				=> $file,
			'active'			=> 1
		]);
		return $file;
	}

	public function delete($file)
	{
		$file = $this->findByPath($file);
		$file->delete($file);
		return $file;
	}
}