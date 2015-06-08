<?php 

namespace Sprim\Repositories\Eloquent;
use Sprim\Repositories\Contracts\UserInterface;
use Sprim\Model\User;
use Carbon\Carbon;

class UserRepository extends AbstractRepository implements UserInterface {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        
        parent::__construct();
    }
    
    protected $fields = [
    	'first_name'        => 'users.first_name',
    	'last_name'         => 'users.last_name'
    ];
    
    public function fields($model, $input)
    {
    	$model->email           = \Helpers::keyInput('email', $input);
    	$model->password        = \Helpers::keyInput('password', $input);    	
    	$model->first_name      = \Helpers::keyInput('first_name', $input);
    	$model->last_name       = \Helpers::keyInput('last_name', $input);
    	$model->password_confirmation		= \Helpers::keyInput('password', $input);
    	 
    	if (array_key_exists('title', $input)){
    		$model->title		= \Helpers::keyInput('title', $input);
    	}
    	
    	if (array_key_exists('password_confirmation', $input)){
    		$model->password_confirmation		= \Helpers::keyInput('password_confirmation', $input);
    	}   	
    	
    	return $model;
    }
        
    public function filteredModel($to_date = null, $from_date = null, $country = null)
    {
    	$jc_where_raw   = '';
    	$has_from_date  = false;
        
    	$model = \DB::table('users')
    		->select(\DB::raw('users.id, users.first_name, users.last_name, users.email'))
    		->leftJoin('users_groups', 'users.id', '=', 'users_groups.user_id');
    	
    	$model->whereRaw('users_groups.group_id = 3');
    
    	if ($country) {
    		$model->whereRaw('(addresses.country_code IN (' . $country . '))');
    	}
    
    	return $model;
    }
    
    private function validate($input)
    {
        $password   = strval(rand(11111111, 99999999));
        
        $user                           = $this->newInstance();
        $user->email                    = $input['email'];
        $user->password                 = $password;
        $user->password_confirmation    = $password;
        $user->first_name               = $input['first_name'];
        $user->last_name                = $input['last_name'];
        
        if (!$user->validate()){
			return false;
		}
        
        return $user;
    }
    
    public function createClientAdmin($client_id, $input)
    {
        $input['profile']['client_id']  = $client_id;
        $input['permissions']           = [$this->clientRoleId() => '1'];
        
        return $this->create($input);
    }

    public function create($input)
    {
        $clnInput = $this->validate($input);
        $is_saved = false;
        if (!$clnInput){
            return false;
        }
        
        try {

            $user = \Sentry::register(['email' => $clnInput->email, 
                'password'      => $clnInput->password, 
                'first_name'    => $clnInput->first_name,
                'last_name'     => $clnInput->last_name]);
            
            $this->addGroup($user, $input['permissions']);
            //$this->saveProfile($user, $input);

            \Session::flash('success', 'New user has been created');
            $is_saved = true;
            
            //$this->sendWelcomeEmail($user);
            
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            \Session::flash('error', 'Login field required.');
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            \Session::flash('error', 'User already exists.');
        }
        
        return $is_saved;
    }
    
    public function getRandomPassword() 
    {
    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array(); //remember to declare $pass as an array
    	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    	for ($i = 0; $i < 8; $i++) {
    		$n = rand(0, $alphaLength);
    		$pass[] = $alphabet[$n];
    	}
    	return implode($pass); //turn the array into a string
    }
    
    private function sendWelcomeEmail($user)
    {
        $data['activationCode']     = $user->GetActivationCode();
        $data['email']              = $user->email;
        $data['userId']             = $user->getId();
        $data['password']           = $user->password;

        \Mail::send('emails.auth.welcome', $data, function($m) use($data)
        {
            $m->to($data['email'])->subject(\Config::get('sprim.site_name'));
        });
    }
    
    private function addGroup($user, $permissions)
    {
        $allGroups   = \Sentry::getGroupProvider()->findAll();
        $permissions = \Utils::filterArray($permissions);
                 
        foreach ($allGroups as $group) {

            if (isset($permissions[$group->id])) 
            {
                $user->addGroup($group);
            } 
        }
    }
    
    private function saveProfile($user, $input)
    {
        
        $input['profile']['user_id'] = $user->id;
        
        //use user model instead of sentry
        $user_model = $this->model->find($user->id);
        
        if (count($user_model->profile)){
            $user_model->profile_id = $user_model->profile->id;
        }
        
        return Utils::profileSave($user_model, $input['profile']);
    }
}