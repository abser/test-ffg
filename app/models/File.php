<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class File extends Ardent {

	protected $table        = 'files';
    protected $softDelete   = false;
    public $timestamps      = false;
    
    public function fileOwners()
    {
        return $this->belongsToMany('Sprim\Model\FileOwner');
    }

}