<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ClubUser extends Ardent {

     // protected $fillable = array();
    //protected $guarded = ['user_id'];
    protected $guarded = array(); 
    public static $rules = array(
        'club_id' => 'required|integer',
        'user_id' => 'required|integer',
        'status' => 'required|in:0,1'
    );

    public function club() {
        return $this->belongsTo('Sprim\Model\Club');
    }

}
