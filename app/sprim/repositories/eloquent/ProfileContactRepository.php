<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\ProfileContactInterface;
use Sprim\Repositories\Eloquent\AbstractContactRepository;
use Sprim\Model\ProfileContact;

class ProfileContactRepository extends AbstractContactRepository implements ProfileContactInterface {

    protected $model;
    protected $label;

    public function __construct(ProfileContact $model)
    {
        $this->model = $model;
        $this->label = 'profile';
    }
    
    public function getByEmail($email)
    {
        return $this->model->where('info', '=', $email)->where('type', '=', \Config::get('sprim.contact_types.email'))
                ->first();
    }
    
    public function getProfileEmail($profile_id, $email)
    {
        return $this->model->whereIn('info', $email)->where('type', '=', \Config::get('sprim.contact_types.email'))
                ->where('profile_id', $profile_id)->first();
    }
    
}