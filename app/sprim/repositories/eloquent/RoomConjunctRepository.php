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

    
}