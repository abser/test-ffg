<?php

use Sprim\Repositories\Contracts\ServiceInterface as Service;
use Sprim\Repositories\Contracts\ClubInterface as Club;
use Sprim\Repositories\Contracts\ServiceCategoryInterface as ServiceCategory;

class ServiceController extends \BaseController {

	public function __construct(Service $service, ServiceCategory $service_category, Club $club)
	{
		$this->model	= $service;
		$this->service	= $service;
		$this->club		= $club;
		$this->service_category = $service_category;
		
		parent::__construct();
		$this->owner_table = Config::get('sprim.tables.service');
		$this->sort      = 'name';
		$this->dir       = 'asc';
		
		$this->route_prefix = 'service';
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$data = $this->getList();
		$data['route']   = 'service.index';
		
		return View::make("service.index", compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['clubs']		= $this->club->getSelectList();
		$data['categories']	= $this->service_category->getSelectList(0);
		$data['sub_categories']	= $this->service_category->getSelectList(1);
		
		return View::make("service.create", compact('data'));
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
		$model              = $this->model->fields($model, $input);
		
		$model->status		= 0;
		$model->created_by 	= \Session::get('user.id');
		
		if (!$model->save()){
			return Redirect::to('service/create')->withErrors($model->errors())->withInput();
		} else {
			return Redirect::to('service');
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
		$data['service']	= $this->model->getById($id, array('service_category'));
		$data['clubs']		= $this->club->getSelectList();
		$data['categories']	= $this->service_category->getSelectList(0);
		$data['sub_categories']	= $this->service_category->getSelectList(1);
		
		if(!$data['service']){
			return Response::view('errors.404', array(), 404);
		}
		
		return View::make('service.edit', compact('data'));
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
			return Redirect::to('service/create')->withErrors($model->errors())->withInput();
		} else {
			return Redirect::to('service');
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
		return Redirect::to('service');
	}
	

	public function activateAction($id)
	{
		$model				= $this->model->find($id);
		$model->status		= 1;
		$model->updated_by 	= \Session::get('user.id');
	
		if (!$model->save()){
			return Redirect::to('service')->withErrors($model->errors())->withInput();
		} else {
				
			Session::flash('message', 'Successfully Activated the Service');
			return Redirect::to('service');
		}
	}
	
	
	public function deactivateAction($id)
	{
		$model   			= $this->model->find($id);
		$model->status		= 0;
		$model->updated_by 	= \Session::get('user.id');
	
		if (!$model->save()){
			return Redirect::to('service')->withErrors($model->errors())->withInput();
		} else {
				
			Session::flash('message', 'Successfully De-Activated the Service');
			return Redirect::to('service');
		}
	}
	

	protected function getList()
	{
		$pageParams         = Helpers::paginatorParams($this->sort, $this->dir);
		$data               = $pageParams;
		$data['r_prefix']   = 'service';
		$data['s_fields']   = array('all' => 'All', 'name' => 'Service Name', 'service_category' => 'Service Category');
	
		$obj                = $this->model->paginate($pageParams);
		$data['model']      = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);
	
		$data['controller']     = 'service';
		return $data;
	}
}
