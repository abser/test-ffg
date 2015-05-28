<?php

use Illuminate\Support\MessageBag;
use Sprim\Repositories\Contracts\UserInterface as User;


class AuthController extends Controller
{
    public function __construct(User $user) 
    {
        $this->user     = $user;        
    }
    
    public function loginAction()
    {
        if (Input::server("REQUEST_METHOD") == "POST") {
            
            $data["email"]  = Input::get("email");
            $validator      = Validator::make(Input::all(), array(
                        "email" => "required",
                        "password" => "required"
                    ));
            
            if ($validator->passes()) {
                $credentials = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password')
                );
                
                $remember_me = (Input::has('remember_me')) ? true : false;
                
                try {
                    $user = Sentry::authenticate($credentials, $remember_me);
                    
                    if ($user) {
                        Sentry::login($user, false);
                        $this->sessionSet();
                        return Redirect::intended(URL::route('index'));
                    }
                } catch (\Exception $e) {
                    return Redirect::route('index')->withErrors(array('login' => $e->getMessage()))
                            ->withInput($data);
                }
            }
            
            $data["email"] = Input::get("email");
            
            return Redirect::route('index')->withErrors($validator)->withInput($data);
        }
        return View::make("auth.login");
    }

    private function sessionSet()
    {
        if (Session::has('user'))
        {
            return true;
        }
        
        // $admin      = Sentry::findGroupByName('sprim');
        // $regional   = Sentry::findGroupByName('regional manager');
        $user       = Sentry::getUser();
        
        $user_model = $this->user->find($user->id);
        
        \Session::put('user.id', $user->id);
        /* Session::put('user.is_admin', $user->inGroup($admin));
        Session::put('user.is_regional_manager', $user->inGroup($regional));
        
        if (count($user_model->profile)){
            
            if(count($user_model->profile->address) && count($user_model->profile->address->country)){
                $countries  = [$user_model->profile->address->country->code];
            
                if ($user->inGroup($regional)){
                    $countries = array_merge($this->geo_region_country->
                            getAllowedCountries($user_model->profile->address->country->code), $countries);
                }
                Session::put('user.countries', array_unique($countries));
            }            
        } */
        // Session::save();
        
        return true;
    }

    public function logoutAction()
    {
        Sentry::logout();
        Session::flush();
        return Redirect::route("index");
    }

    public function activateAction($userId = null, $activationCode = null)
    {
        try {
            // Find the user
            $user = Sentry::getUserProvider()->findById($userId);

            // Attempt user activation
            if ($user->attemptActivation($activationCode)) {
                // User activation passed
                //Add this person to the user group. 
                // $userGroup = Sentry::getGroupProvider()->findById(1);
                // $user->addGroup($userGroup);

                Session::flash('success', 'Your account has been activated. <a href="/login">Click here</a> to log in.');
                return Redirect::route('index');
            } else {
                // User activation failed
                Session::flash('error', 'There was a problem activating this account. Please contact the system administrator.');
                return Redirect::route('index');
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            Session::flash('error', 'User does not exist.');
            return Redirect::route('index');
        } catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e) {
            Session::flash('error', 'You have already activated this account.');
            return Redirect::route('index');
        }
    }

    public function requestAction()
    {
        $errors = new MessageBag();
        if ($old = Input::old("errors")) {
            $errors = $old;
        }
        
        $data = array(
            "requested" => Input::old("requested"),
            "errors" => $errors
        );
        if (Input::server("REQUEST_METHOD") == "POST") {
            $validator = Validator::make(Input::all(), array(
                        "email" => "required"
                    ));
            if ($validator->passes()) {
                $credentials = array(
                    "email" => Input::get("email")
                );
                
                try {
                    $user = Sentry::findUserByCredentials($credentials);

                    if ($user) {
                        $code = $user->getResetPasswordCode();
                        $mail['user']   = ($user->first_name)? $user->first_name : $user->email;
                        $mail['code']   = $code;
                        $mail['email']  = Input::get("email");
                        $mail['userId']             = $user->getId();
                        $mail['activationCode']     = $user->GetActivationCode();

                        Mail::send('emails.auth.reminder', $mail, function($m) use($mail)
                        {
                            $m->to($mail['email'])->subject(Config::get('sprim.site_name').' Password Recovery');
                        });
                        Session::flash('success', 'A reset code has been sent to your email.');
                    }
                } catch (\Exception $e) {
                    Session::flash('error', 'There is no user associated with that email.');
                    return Redirect::route('auth.request')->withErrors($e->getMessage())->withInput();
                }
                return Redirect::route("auth.reset");
            }
            
            $data["errors"] = new MessageBag(array(
                "email" => array(
                    "Valid email is required."
                )
            ));
        }
        return View::make("auth.request", $data);
    }

    public function resetAction()
    {
        //Input::get("token") = $token;
        $errors = new MessageBag();
        if ($old = Input::old("errors")) {
            $errors = $old;
        }
        $data = array(
            "errors" => $errors
        );
        if (Input::server("REQUEST_METHOD") == "POST") {
            $validator = Validator::make(Input::all(), array(
                        "code" => "required",
                        "password" => "required|min:6",
                        "password_confirmation" => "same:password"
                    ));
            
            if ($validator->passes()) {
                
                try {
                    $user = Sentry::findUserByResetPasswordCode(Input::get('code'));
                    
                    if ($user->checkResetPasswordCode(Input::get('code')))
                    {
                        if ($user->attemptResetPassword(Input::get('code'), Input::get('password')))
                        {
                            Session::flash('success', 
                                    'Your password has been reset.');
                            return Redirect::route('index');
                        }
                        else
                        {
                            Session::flash('error', 
                                    'There was a problem activating this account. Please contact the system administrator.');
                            return Redirect::route('index');
                        }
                    }
                    $validator->getMessageBag()->add('code', 'Invalid code');

                } catch (\Exception $e) {
                    return Redirect::route('auth.request')->withErrors($e->getMessage())->withInput();
                }
                
            }
            
            $data["email"] = Input::get("email");
            $data["errors"] = $validator->errors();
            
            return Redirect::route('auth.request')->withErrors($validator->errors())->withInput($data);
        }
        return View::make("auth.reset", $data);
    }

    public function changePasswordAction() {
    	
    	$errors = new MessageBag();    	
    	$data	= array(
    			"errors" => $errors
    	);
    	
    	$user	= Sentry::getUser();
    	
    	if (Input::server("REQUEST_METHOD") == "POST") {
    		$validator = Validator::make(Input::all(), array(
    				"current_password" => "required",
    				"password" => "required|different:current_password|min:6",
    				"password_confirmation" => "required|same:password"
    		));
    	
    		if ($validator->passes()) {
    			
    			try {
    			    			
    				$credentials = array(
    					'email' => $user->email,
    					'password' => Input::get('current_password')
    				);
    			
    				try {
    					$user = Sentry::findUserByCredentials($credentials);
    					
    					if ($user) {
    					
    						$user->password = Input::get('password');
    						// $resetCode = $user->getResetPasswordCode();
    						// if ($user->attemptResetPassword($resetCode, Input::get('password')))
    						if ($user->save())
    						{
    							Sentry::logout();
    							Session::flush();
    							Session::flash('success', 'Your password has been reset. Your session will expire automatically. Please log in with your new password.');
    							return Redirect::route('index');
    						}
    						else
    						{
    							Session::flash('error',
    							'There was a problem activating this account. Please contact the system administrator.');
    							return Redirect::route('index');
    						}
    					}    					
    				} catch (\Exception $e) {
    					$validator->getMessageBag()->add('current_password', 'Invalid Current Password');    					
    				} 
    				$validator->getMessageBag()->add('current_password', 'Invalid Current Password');
    				
    			} catch (\Exception $e) {
    				return Redirect::route('auth.change-password')->withErrors($e->getMessage())->withInput();
    			}   			
    		}
    		
    		$data["errors"] = $validator->errors();
    	}    	
    	 	
    	$user_model		= $this->user->find($user->id);    	
    	$data['email']	= $user->email;
    	
    	
    	return View::make("auth.change-password", $data);
    }
}
