<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\ProfileContacts;
use Sprim\Repositories\Contracts\ProfileContactsInterface;

class ProfileContactsRepository extends AbstractRepository implements ProfileContactsInterface {

    protected $model;

    public function __construct(UserProfile $model) {
        $this->model = $model;
    }

}