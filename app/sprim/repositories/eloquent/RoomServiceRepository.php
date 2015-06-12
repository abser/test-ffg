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
    	$this->model->where('room_id', '=', $_room_id)->delete();
        
    	if (array_key_exists('id', $input)){
        	foreach ($input['id'] as $id){
        		
        		$model				= $this->model->newInstance();
        		$model->room_id		= $_room_id; 
        		$model->service_id	= $id;
        		$model->created_by	= \Session::get('user.id');
        		
        		$model->save();
        		
            	// $this->create(['room_id' => $_room_id, 'service_id' => $id]);
            }
    	} 
    }
}