<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\UserProfileInterface;
use Sprim\Repositories\Contracts\AddressInterface as Address;

use Sprim\Model\UserProfile;

class UserProfileRepository extends AbstractRepository implements UserProfileInterface {

    protected $model;

    public function __construct(UserProfile $model, Address $address)
    {
        $this->model	= $model;
        $this->address	= $address;
    }

	public function _save($input, $_profile_id = null)
    {
        if (!array_filter($input)){
            return false;
        }
        
        if ($_profile_id){
        	$profile = $this->find($_profile_id);
        } else {
        	$profile = new $this->model;
        }
               
        if (array_key_exists('address', $input)){        	
            $input['address_id'] = $this->address->_save($input['address'], $profile->address_id);
        }

        $profile->user_id       = \Helpers::keyInput('user_id', $input);
        $profile->address_id    = \Helpers::keyInput('address_id', $input);        
       
//         if($profile->save()){
            
//             return $profile->id;
//         }
    }
    
    public function hasDuplicate($profile)
    {
    	$duplicate = $this->model->where('first_name', '=', $profile['first_name'])->where('last_name', '=', $profile['last_name'])->first();
    	 
    	if(!$duplicate){
    		return false;
    	}
    
    	return $duplicate->id;
    }
}
