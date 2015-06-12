<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class FileOwner extends Ardent {

	protected $table        = 'file_owners';
    protected $softDelete   = false;
    public $timestamps      = false;
    
    public function file() 
    {
        return $this->belongsTo('Sprim\Model\File', 'file_id');
    }

}