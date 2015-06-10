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
    
    public function _save($related_model, $input, $no_duplicate = false)
    {
        if (!array_filter($input)){
            return false;
        }
        
        $profile_id = null;
        $address_id = null;
        
        if($no_duplicate && $has_duplicate = $this->hasDuplicate($input)){
            
            if (array_key_exists('address', $input)){
                $profile    = $this->find($has_duplicate);

                if ($profile->address_id){
                    $address_id = $profile->address_id;
                } 
                
                $this->address->allow_null = $this->allow_null;
                $input['address_id'] = $this->address->_save($input['address'], $address_id);
            }
            
            return $has_duplicate;
        }

        if ($related_model->profile_id){
            $profile    = $this->find($related_model->profile_id);
            $profile_id = $profile->id;

            if ($profile->address_id){
                $address_id = $profile->address_id;
            } 
        } else {
            $profile = $this->newInstance();
        }
        
        if (array_key_exists('address', $input)){
        	$this->address->allow_null = $this->allow_null;
            $input['address_id'] = $this->address->_save($input['address'], $address_id);
        }
        
        $profile->first_name            = $input['first_name'];
        $profile->last_name             = $input['last_name'];
        
        $profile->address_id    = \Helpers::keyInput('address_id', $input);
        $profile->birth_date    = \Helpers::keyInput('birth_date', $input);
        $profile->user_id       = \Helpers::keyInput('user_id', $input);
        
        if(!$this->allow_null){
        	$profile = $this->keepOldData($profile);
        }

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