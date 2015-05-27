<?php

use Sprim\Repositories\Contracts\ClubInterface as Club;

class ClubController extends \BaseController {

	public function __construct(Club $club) {
		
		$this->model	= $club;
		$this->club		= $club;
		
		parent::__construct();
		$this->owner_table = Config::get('sprim.tables.club');
		$this->sort      = 'name';
		$this->dir       = 'asc';
		
		$this->route_prefix = 'club';
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $data['clubs'] = $this->model->all();
		$data = $this->getList();
		$data['route']   = 'club.index';
		
		return View::make("club.index", compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{				
		return View::make("club.create");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input              = Input::all();
		$model              = $this->model->newInstance();
		$model->status		= 0;
		$model->created_by  = Session::get('user.id');
		$model              = $this->model->fields($model, $input);			
		// dd(Sentry::getUser());
		// dd(Session::all());
		
		if (!$model->save()){
			return Redirect::to('club/create')->withErrors($model->errors())->withInput();
		} else {		
			return Redirect::to('club');
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['club']	= $this->model->getById($id, array('address'));
		
		if(!$data['club']){
			return Response::view('errors.404', array(), 404);
		}
		
		return View::make('club.edit', compact('data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input  = Input::all();		
		$model  = $this->model->fields($this->model->find($id), $input);
		$model->updated_by 	= \Session::get('user.id');
		
		if (!$model->save()){
			return Redirect::to('club/create')->withErrors($model->errors())->withInput();
		} else {
			return Redirect::to('club');
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
		try {
			$this->model->deleteById($id);
		} catch (Exception $e) {
			$msg = 'Error: Unable to delete.';
			Session::flash('error', $msg);
			return Redirect::back();
		}
		
		Session::flash('message', 'Successfully deleted the HCP profile!');
		return Redirect::to('club');
	}

	
	public function activateAction($id)
	{
		$model				= $this->model->find($id);
		$model->status		= 1;
		$model->updated_by 	= \Session::get('user.id');
		
		if (!$model->save()){
			return Redirect::to('club')->withErrors($model->errors())->withInput();
		} else {
			
			Session::flash('message', 'Successfully Activated the Club');
			return Redirect::to('club');
		}
	}
	
	public function deactivateAction($id)
	{
		$model   			= $this->model->find($id);
		$model->status		= 0;
		$model->updated_by 	= \Session::get('user.id');
		
		if (!$model->save()){
			return Redirect::to('club')->withErrors($model->errors())->withInput();
		} else {
			
			Session::flash('message', 'Successfully De-Activated the Club');
			return Redirect::to('club');
		}
	}
	
	protected function getList()
	{
		$pageParams         = Helpers::paginatorParams($this->sort, $this->dir);
		$data               = $pageParams;
		$data['r_prefix']   = 'club';
		$data['s_fields']   = array('all' => 'All', 'name' => 'Club Name', 'country' => 'Country');
	
		$obj                = $this->model->paginate($pageParams);
		$data['model']      = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);
	
		$data['controller']     = 'club';		
		return $data;
	}

}
