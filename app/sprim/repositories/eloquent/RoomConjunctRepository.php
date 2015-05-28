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

    
}