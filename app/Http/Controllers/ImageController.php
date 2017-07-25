<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
	/**
	 *	@param string $file
	 *	@return \Illuminate\Http\Response
	 */
	public function getImage($file)
	{
		return Image::make(storage_path("app/public/images/$file"));
	}

	/**
	 * 	Display an Image
	 *	@param string $file
	 *	@return \Illuminate\Http\Response
	 */
	public function show($file)
	{
		$image = $this->getImage($file);
		return $image->response('jpg');
	}

	/**
	 * 	Resize an Image and Display
	 *	@param int $width
	 *	@param string $file
	 *	@return \Illuminate\Http\Response
	 */
	public function resize($width, $file)
	{
		$image = $this->getImage($file);
		$image->resize($width, null, function($constraint){
			$constraint->aspectRatio();
		});
		return $image->response('jpg');
	}

	/**
	 * 	Fit an Image and Display
	 *	@param int $width
	 *	@param int $height
	 *	@param string $file
	 *	@return \Illuminate\Http\Response
	 */
	public function fit($width, $height, $file)
	{
		$image = $this->getImage($file);
		$image->fit($width, $height, function ($constraint) {
			$constraint->upsize();
		});
		return $image->response('jpg');
	}
}
