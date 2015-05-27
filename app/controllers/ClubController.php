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
		$model->created_by  = Session::get('user.id');
		$club               = $this->model->fields($model, $input);
		
		$club->status		= 0;
		$club->created_by 	= \Session::get('user.id');		
		// dd(Sentry::getUser());
		// dd(Session::all());
		
		if (!$club->save()){
			return Redirect::to('club/create')->withErrors($club->errors())->withInput();
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
		$data['club']	= $this->club->getById($id, array('address'));
		
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
		$club   = $this->club->fields($this->club->find($id), $input);
		$club->updated_by 	= \Session::get('user.id');
		
		if (!$club->save()){
			return Redirect::to('club/create')->withErrors($club->errors())->withInput();
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
			$this->club->deleteById($id);
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
		$club				= $this->club->find($id);
		$club->status		= 1;
		$club->updated_by 	= \Session::get('user.id');
		
		if (!$club->save()){
			return Redirect::to('club')->withErrors($club->errors())->withInput();
		} else {
			
			Session::flash('message', 'Successfully Activated the Club');
			return Redirect::to('club');
		}
	}
	
	public function deactivateAction($id)
	{
		$club   			= $this->club->find($id);
		$club->status		= 0;
		$club->updated_by 	= \Session::get('user.id');
		
		if (!$club->save()){
			return Redirect::to('club')->withErrors($club->errors())->withInput();
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
