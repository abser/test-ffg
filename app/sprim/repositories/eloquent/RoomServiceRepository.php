<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\RoomServiceInterface;
use Sprim\Model\RoomService;

class RoomServiceRepository extends AbstractRepository implements RoomServiceInterface {

    protected $model;
  
    public function __construct(RoomService $model) {
        
        $this->model	= $model;

        parent::__construct();
    }

    public function _save($input, $_room_id)
    {
    	if ($_room_id){
    		$room_service = $this->find($_room_id);
    	} else {
    		$room_service				= new $this->model;
    		$room_service->room_id		= $_room_id;
    		$room_service->service_id 	= \Session::get('user.id');
    		$room_service->created_by 	= \Session::get('user.id');
    	}
    	 
    	if($room_service->save()){
    
    		return $room_service->id;
    	}
    
    }
}