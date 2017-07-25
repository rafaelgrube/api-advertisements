<?php
	namespace App\Http\Transformer;

	use App\Models\Picture;
	Use League\Fractal\TransformerAbstract;

	class PictureTransformer extends TransformerAbstract
	{

		function transform(Picture $picture)
		{
			return [
				'file' => url('/images/'.$picture->file),
			];
		}
	}