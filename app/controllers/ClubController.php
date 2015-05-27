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
		
		dd($club);
		 
		/* if (!$club->save()){
			return Redirect::to('clubs/create')->withErrors($club->errors())->withInput();
		} else {		
			return Redirect::to('clubs');
		} */
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	
	protected function getList()
	{
		$pageParams         = Helpers::paginatorParams($this->sort, $this->dir);
		$data               = $pageParams;
		$data['r_prefix']   = 'club';
		$data['s_fields']   = array('all' => 'All',
				'name'    => 'Club Name');
	
		$obj                = $this->model->paginate($pageParams);
		$data['model']      = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);
	
		$data['controller']     = 'club';		
		return $data;
	}

}
