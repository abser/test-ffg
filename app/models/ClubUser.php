<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ClubUser extends Ardent {

    public function club() {
        return $this->belongsTo('Sprim\Model\Club');
    }

}
