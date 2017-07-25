<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests\PictureRequest;
use App\Http\Transformer\PictureTransformer;
use App\Models\Advertisement;
use App\Models\Picture;
use App\Repositories\AdvertisementsRepository;
use App\Repositories\PicturesRepository;


class PictureController extends Controller
{
	public function __construct(PicturesRepository $repository, AdvertisementsRepository $advertisement)
	{
		$this->repository = $repository;
		$this->advertisement = $advertisement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response('Forbidden', 403);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return response('Forbidden', 403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PictureRequest $request, $advertisement)
	{
		$advertisement = $this->advertisement->findByUuid($advertisement);

		if ($request->file('file')->isValid()) {
			$file = $request->file->store('/', 'images');
			if( $file ) {
				$picture = $this->repository->create($advertisement->id, $file);
			}
		}
		return fractal($picture, new PictureTransformer())->respond(201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return response('Forbidden', 403);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return response('Forbidden', 403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		return response('Forbidden', 403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string $uuid (UUID for an advertisement)
	 * @param  string (Path for a file)  $file
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uuid, $file)
	{
		$file = $this->repository->delete($file);
		return fractal($file, new PictureTransformer())->respond(204);
	}
}
