<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\ClubUserInterface;
use Sprim\Model\ClubUser;

class ClubUserRepository extends AbstractRepository implements ClubUserInterface {

    protected $model;

    public function __construct(ClubUser $model) {
        $this->model = $model;
    }

    public function _save($_user_id, $clubs)
    {
    	if (empty($_user_id) || empty ($clubs)){
            return;
        }
        
        // dd($clubs);
        
        $clubs_arr = (!is_array($clubs))? array($clubs) : $clubs;
        
        $clubs = array_filter(array_map('trim', $clubs_arr));
        
        if(!$clubs){
        	return true;
        }
        
        $check_delete    = $this->model->where('user_id', '=', $_user_id)->get();
        
        foreach ( $check_delete as $club_user){
        	if(!in_array($club_user->club_id, $clubs)){
        		$this->model->where('user_id', '=', $_user_id)->where('club_id', '=', $club_user->club_id)->delete();
        	}
        }        
    
        foreach ( $clubs as $club ){
        
        	$new                = $this->newInstance();
        	$new->user_id       = $_user_id;
        	$new->club_id       = $club;
        	$new->status        = 1;
        	$new->created_by	= \Session::get('user.id');
        	        
        	$check_exist    = $this->model->where('user_id', '=', $_user_id)->where('club_id', '=', $club)->get();
        
        	if ($check_exist->isEmpty()) {
        		$new->save();
        	}
        }
        
        return true;
        
    }
}