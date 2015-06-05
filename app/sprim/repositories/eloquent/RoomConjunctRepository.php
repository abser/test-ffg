<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\RoomConjunctInterface;
use Sprim\Model\RoomConjunct;

class RoomConjunctRepository extends AbstractRepository implements RoomConjunctInterface {

    protected $model;
  
    public function __construct(RoomConjunct $model) {
        
        $this->model	= $model;

        parent::__construct();
    }

    public function _save($input, $_room_id)
    {
    	$this->model->where('room_id', '=', $_room_id)->delete();
    
    	foreach ($input as $id){
    
    		$model				= $this->model->newInstance();
    		$model->room_id		= $_room_id;
    		$model->conjunct_room_id	= $id;
    		$model->created_by	= \Session::get('user.id');
    
    		$model->save();
    
    		// $this->create(['room_id' => $_room_id, 'service_id' => $id]);
    	}
    	
    }
}