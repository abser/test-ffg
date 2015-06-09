<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\ServiceUsersInterface;
use LaravelBook\Ardent\Ardent;

class ServiceUsers extends Ardent implements ServiceUsersInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_users';
    protected $guarded = ['id'];

}
