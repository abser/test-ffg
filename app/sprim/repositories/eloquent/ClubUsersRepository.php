<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\ClubUsers;
use Sprim\Repositories\Contracts\ClubUsersInterface;

class ClubUsersRepository extends AbstractRepository implements ClubUsersInterface {

    protected $model;

    public function __construct(ClubUsers $model) {
        $this->model = $model;
    }

}