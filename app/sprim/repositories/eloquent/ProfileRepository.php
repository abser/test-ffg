<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\ProfileInterface;
use Sprim\Repositories\Contracts\AddressInterface as Address;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\Profile;

class ProfileRepository extends AbstractRepository implements ProfileInterface {

    protected $model;
    public $allow_null = true;

    public function __construct(Profile $model, Address $address)
    {
        $this->model    = $model;
        $this->address  = $address;
    }
    
    public function _save($_user_id, $input)
    {
        if (!array_filter($input)){
            return false;
        }
        
        $profile_id = null;
        $address_id = null;
        
        $profile    = $this->model->where('user_id', '=', $_user_id)->first();
        
        if (!$profile) {
        	$profile = $this->newInstance();
        	$profile->created_by 	= \Session::get('user.id');
        }
               
        if (array_key_exists('address', $input)) {
        	
        	if ($profile && $profile->address_id) {
        		$address_id = $profile->address_id;
        	}
        	
        	$input['address_id'] = $this->address->_save($input['address'], $address_id);
        }
        
        // ["phone"]=> string(0) "" ["mobile"]=> string(0) "" 
        // ["picture"]=> string(7) "man.jpg" ["qualifications"]=> string(0) "" ["personal_philosophy"]=> string(0) "" ["accept_appointment"]=> string(1) "1"
        //  ["address_id"]=> string(1) "7" }
        
        
                      
        if (array_key_exists('profile', $input)) {
        	$profile->title		    = \Helpers::keyInput('title', $input['profile']);
        }
        $profile->first_name    = \Helpers::keyInput('first_name', $input);
        $profile->last_name     = \Helpers::keyInput('last_name', $input);
        
        $profile->address_id    = \Helpers::keyInput('address_id', $input);
        // $profile->birth_date    = \Helpers::keyInput('birth_date', $input);
        $profile->user_id       = $_user_id;
                
        if (array_key_exists('profile', $input)) {
        	$profile->qualification		= \Helpers::keyInput('qualification', $input['profile']);
        	$profile->description		= \Helpers::keyInput('description', $input['profile']);
        }
        
        $profile->accept_appointment	= 0;        
        if (array_key_exists('accept_appointment', $input)){
        	$profile->accept_appointment	= \Helpers::keyInput('accept_appointment', $input);
        }
        
        // dd($profile);
              
        if($profile->save()){
            
            return $profile->id;
        }
    }
    
    public function hasDuplicate($profile)
    {
        $duplicate = $this->model->where('first_name', '=', $profile['first_name'])->
                where('last_name', '=', $profile['last_name'])->first();
       
        if(!$duplicate){
            return false;
        }
        
        return $duplicate->id;
    }
    
    public function searchName($term)
    {
        return $this->model->orderBy('first_name')->
                whereRaw('(first_name LIKE "%'.$term.'%" OR last_name LIKE "%'.$term.'%" )')->get();
    }
    
    public function tryDelete($id)
    {
        $model = $this->getById($id);
        
        if (count($model->hcp) || count($model->advisoryBoard) || count($model->speaker)){
            return true;
        }
        
        return $model->delete();
    }
    
}