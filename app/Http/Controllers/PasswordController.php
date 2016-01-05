<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth,Validator,Hash;

class PasswordController extends Controller
{
    

    public function getChangePassword(){
    	return view('auth.password');
    }

    public function postChangePassword(Request $request){

    	$Validator = $this->validatePasswordChange($request->input());
    	if($Validator->fails()){
    		return redirect()->back()->withErrors($Validator);
    	}

    	if(!Hash::check($request->input('old_password'),Auth::user()->password)){
    		$Validator->getMessageBag()->add('old_password','Password incorrect');
    		return redirect()->back()->withErrors($Validator);
    	}

    	$User = Auth::user();
		$User->password = Hash::make($request->input('new_password'));
		$User->save();

		\Session::flash('success_message',"Password changed successfully");

    	return redirect('/');
    }

    protected function validatePasswordChange($data){
    	$rules = [
	    	'old_password' => 'required',
	    	'new_password' => 'required|min:8|confirmed'
		];
		return Validator::make($data,$rules);
    }
}
