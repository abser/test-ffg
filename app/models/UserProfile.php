<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\UserProfileInterface;
use LaravelBook\Ardent\Ardent;

class UserProfile extends Ardent implements UserProfileInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profile';
    protected $guarded = ['id'];

}
