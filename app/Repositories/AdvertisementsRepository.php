<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use Auth;
use DB;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

use App\Models\Advertisement;
use App\Models\User;

class AdvertisementsRepository
{
	public function getAll()
	{
		return Advertisement::all();
	}

	public function findByUuid($uuid)
	{
		return Advertisement::where('uuid', $uuid)->where('user_id', Auth::user()->id)->first();
	}

	public function showByUuid($uuid)
	{
		return Advertisement::where('uuid', $uuid)->first();
	}

	public function create($title, $description, $tags, $price)
	{
		$advertisement = (new Advertisement)->fill([
			'user_id' 		=> Auth::user()->id,
			'uuid'			=> Uuid::uuid4(),
			'title'			=> $title,
			'description'	=> $description,
			'tags'			=> $tags,
			'price'			=> $price,
		]);

		$advertisement->save();

		return $advertisement;
	}

	public function update($id, $title, $description, $tags, $price)
	{
		$advertisement = Advertisement::find($id);
		$advertisement->update([
			'title'			=> $title,
			'description'	=> $description,
			'tags'			=> $tags,
			'price'			=> $price,
		]);
		return $advertisement;
	}

	public function delete($id)
    {
        $advertisement = Advertisement::find($id);
        $advertisement->delete();
        return $advertisement;
    }

    public function publishedAt($id)
    {
    	$advertisement = Advertisement::find($id);
    	$advertisement->published_at = $advertisement->published_at ? null : Carbon::now();
    	$advertisement->save();
    	return $advertisement;
    }

    public function fetchPublished($filter = '')
    {
    	$query = Advertisement::query()->whereNotNull('published_at');

    	if ($filter) {
    		$match = "MATCH(title, description, tags) AGAINST ( '$filter' IN BOOLEAN MODE)";

    		$relevance = DB::raw("*, $match as relevance");

    		$query->select($relevance)->whereRaw($match)->orderBy('relevance')->get();
    	}

    	return $query->get();
    }
}