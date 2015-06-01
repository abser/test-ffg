<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\ProfileContactsInterface;
use LaravelBook\Ardent\Ardent;

class ProfileContacts extends Ardent implements ProfileContactsInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_contacts';
    protected $guarded = ['id'];

}
