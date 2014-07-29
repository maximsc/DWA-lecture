<?php

class UserController extends BaseController {


	public function __construct() {
        $this->beforeFilter('guest', array('only' => array('getLogin')));	
    }

	
	
	public function getSignup() {
		
		return View::make('user_signup');
		
	}
	
	public function postSignup() {
					
		$rules = array(
			'email' => 'email|unique:users,email',
			'password' => 'min:6'	
		);			
					
		$validator = Validator::make(Input::all(), $rules);
		
		if($validator->fails()) {
			
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput()
				->withErrors($validator);
		}
					
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		
		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}
		
		# Log in
		Auth::login($user);
		
		return Redirect::to('/list')->with('flash_message', 'Welcome to Foobooks!');
				
	}
	
	public function getLogin() {
		

		return View::make('user_login');
		
	}
	
	public function postLogin() {
		
		$credentials = Input::only('email', 'password');
	
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}
		
		return Redirect::to('login');
				
	}
	
	
	public function getLogout() {
		
		# Log out
		Auth::logout();
	
		# Send them to the homepage
		return Redirect::to('/');

	}
		
}