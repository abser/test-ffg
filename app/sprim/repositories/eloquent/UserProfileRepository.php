<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\UserProfile;
use Sprim\Repositories\Contracts\UserProfileInterface;

class UserProfileRepository extends AbstractRepository implements UserProfileInterface {

    protected $model;

    public function __construct(UserProfile $model) {
        $this->model = $model;
    }

}
