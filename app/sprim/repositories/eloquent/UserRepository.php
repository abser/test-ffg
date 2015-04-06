<?php 

namespace Sprim\Repositories\Eloquent;
use Sprim\Repositories\Contracts\UserInterface;
use Sprim\Model\User;

class UserRepository extends AbstractRepository implements UserInterface {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        
        parent::__construct();
    }
    
    public function fields($model, $input)
    {
        
    }
    
    private function validate($input)
    {
        $password   = strval(rand(11111111, 99999999));
        
        $user                           = $this->newInstance();
        $user->email                    = $input['email'];
        $user->password                 = $password;
        $user->password_confirmation    = $password;
        $user->first_name               = $input['profile']['first_name'];
        $user->last_name                = $input['profile']['last_name'];
        
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
            $this->saveProfile($user, $input);

            \Session::flash('success', 'New user has been created');
            $is_saved = true;
            
            $this->sendWelcomeEmail($user);
            
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