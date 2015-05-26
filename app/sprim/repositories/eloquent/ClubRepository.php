<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\ClubInterface;
use Sprim\Repositories\Contracts\AddressInterface as Address;
use Sprim\Model\Club;

class ClubRepository extends AbstractRepository implements ClubInterface {

    protected $model;

    public function __construct(Club $model, Address $address) {
        
        $this->model = $model;
        $this->address = $address;

        parent::__construct();
    }
}