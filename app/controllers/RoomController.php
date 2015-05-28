<?php

use Sprim\Repositories\Contracts\RoomInterface as Room;
use Sprim\Repositories\Contracts\RoomServiceInterface as RoomService;
use Sprim\Repositories\Contracts\RoomConjunctInterface as RoomConjunct;
use Sprim\Repositories\Contracts\ClubInterface as Club;
use Sprim\Repositories\Contracts\ServiceInterface as Service;
use Sprim\Repositories\Contracts\ServiceCategoryInterface as ServiceCategory;

class RoomController extends \BaseController {

	public function __construct(Room $room, RoomService $room_service, RoomConjunct $room_conjunct, Club $club,
			Service $service, ServiceCategory $service_category) {
	
		$this->model			= $room;
		$this->room				= $room;
		$this->room_service		= $room_service;
		$this->room_conjunct	= $room_conjunct;
		$this->club				= $club;
		$this->service			= $service;
		$this->service_category	= $service_category;
	
		parent::__construct();
		$this->owner_table = Config::get('sprim.tables.room');
		$this->sort      = 'name';
		$this->dir       = 'asc';
	
		$this->route_prefix = 'room';
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = $this->getList();
		$data['route']   = 'room.index';
		
		return View::make("room.index", compact('data'));
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
		
		return View::make("room.create", compact('data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$data['r_prefix']   = 'room';
		$data['s_fields']   = array('all' => 'All', 'name' => 'Room Name', 'service_category' => 'Service Category');
					
		$obj                = $this->model->paginate($pageParams);
		$data['model']      = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);
	
		$data['controller']     = 'room';
		return $data;
	}
}