<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ClubUser extends Ardent {

    //  protected $fillable = array('club_id', 'user_id', 'type', 'status');
    //protected $guarded = ['user_id'];
    public static $rules = array(
        'club_id' => 'required|integer',
        'user_id' => 'required|integer',
        'status' => 'required|in:0,1'
    );

    public function club() {
        return $this->belongsTo('Sprim\Model\Club');
    }

}
