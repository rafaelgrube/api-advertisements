<?php
	namespace App\Http\Transformer;

	use App\Models\Advertisement;
	Use League\Fractal\TransformerAbstract;

	class AdvertisementTransformer extends TransformerAbstract
	{

		function transform(Advertisement $advertisement)
		{
			return [
				'uuid'			=> $advertisement->uuid,
				'title'			=> $advertisement->title,
				'description'	=> $advertisement->description,
				'tags'			=> $advertisement->tags,
				'price'			=> $advertisement->price,
				'published_at'	=> $advertisement->published_at,
			];
		}
	}