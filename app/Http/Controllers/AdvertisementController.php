<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AdvertisementRequest;
use App\Http\Transformer\AdvertisementTransformer;
use App\Http\Transformer\PictureTransformer;
use App\Models\Advertisement;
use App\Repositories\AdvertisementsRepository;

class AdvertisementController extends Controller
{
	private $repository;

	public function __construct(AdvertisementsRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$advertisements = $this->repository->getAll();
		return fractal($advertisements, new AdvertisementTransformer());
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
	public function store(AdvertisementRequest $request)
	{
		$advertisement = $this->repository->create(
			$request->title,
			$request->description,
			$request->tags,
			$request->price
		);
		return fractal($advertisement, new AdvertisementTransformer());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function show($uuid)
	{
		$advertisement = $this->repository->findByUuid($uuid);
		return fractal($advertisement, new AdvertisementTransformer);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Advertisement $advertisement)
	{
		return response('Forbidden', 403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function update(AdvertisementRequest $request, $uuid)
	{
		$uuid = $this->repository->findByUuid($uuid);
		$advertisement = $this->repository->update(
			$uuid->id,
			$request->title,
			$request->description,
			$request->tags,
			$request->price
		);
		return fractal($advertisement, new AdvertisementTransformer);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uuid)
	{
		$uuid = $this->repository->findByUuid($uuid);
		$advertisement = $this->repository->delete($uuid->id);
		return fractal($advertisement, new AdvertisementTransformer);
	}

	/**
	 * Update the specified resource from storage.
	 *
	 * @param  string  $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function togglePublished($uuid)
	{
		$uuid = $this->repository->findByUuid($uuid);
		$advertisement = $this->repository->publishedAt($uuid->id);
		return fractal($advertisement, new AdvertisementTransformer);
	}

	/**
	 * Show all pictures resource from an advertisement.
	 *
	 * @param  string  $uuid
	 * @return \Illuminate\Http\Response
	 */

	public function pictures($uuid)
	{
		$advertisement = $this->repository->findByUuid($uuid);
		$pictures = $advertisement->pictures;
		return fractal($pictures, new PictureTransformer);
	}

	/**
	 * Show an advertisement.
	 *
	 * @param  string  $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function showAdvertisement($uuid)
	{
		$advertisement = $this->repository->showByUuid($uuid);
		return fractal($advertisement, new AdvertisementTransformer);
	}

	/**
	 * Show all pictures resource from an advertisement.
	 *
	 * @param  string  $uuid
	 * @return \Illuminate\Http\Response
	 */
	public function showAdvertisementPictues($uuid)
	{
		$advertisement = $this->repository->showByUuid($uuid);
		$pictures = $advertisement->pictures;
		return fractal($pictures, new PictureTransformer);
	}

	/**
	 * Search advertisements by partial title, description or tags
	 * @param Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function searchAdvertisement(Request $request)
	{
		$advertisements = $this->repository->fetchPublished($request->q);
		return fractal($advertisements, new AdvertisementTransformer);
	}
}
