<?php

class LotController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Lists all lots
		$lots = Lot::all();
		return View::make('lot.index')->with('lots', $lots);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('lot.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Validation
		$rules = array('lot_no' => 'required|unique:lots,lot_no');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('lot.create')->withErrors($validator)->withInput();
		} else {
			// Add
			$lot = new Lot;
			$lot->lot_no = Input::get('lot_no');
			$lot->description = Input::get('description');
			$lot->expiry = Input::get('expiry');

			$lot->save();

			$url = Session::get('SOURCE_URL');
			return Redirect::to($url)
					->with('message', trans('messages.successfully-created-lot'));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lot = Lot::find($id);
		return View::make('lot.show')->with('lot', $lot);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$lot = Lot::find($id);
		return View::make('lot.edit')->with('lot', $lot);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Validation
		$rules = array('lot_no' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('lot/'.$id.'/edit')->withErrors($validator)->withInput();
		} else {
			// Add
			$lot = Lot::findOrFail($id);
			$lot->lot_no = Input::get('lot_no');
			$lot->description = Input::get('description');
			$lot->expiry = Input::get('expiry');

			$lot->save();

			$url = Session::get('SOURCE_URL');
			return Redirect::to($url)
					->with('message', trans('messages.successfully-updated-lot'));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Remove the specified lot from storage (global UI implementation).
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		//Delete the lot
		$lot = Lot::find($id);
 
		$lot->delete();

		// redirect
		return Redirect::route('lot.index')->with('message', trans('messages.success-deleting-lot'));
	}


}
