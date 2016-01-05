<?php

namespace App;

use Illuminate\Database\Eloquent\Model,Auth;

class SpeedDial extends Model
{

	public function Customer(){
		return $this->hasOne('App\Customer','id','customer');
	}

	public function buildDialPlan(){

	}

	public function isInUse(){
		$Extension = Extension::where('customer',Auth::user()->customer)->where('app','Goto')->where('appdata',Auth::user()->Customer->internal_context.','.$this->sd_exten.',1')->first();
		if($Extension){
			return true;
		}
		return false;
	}
    
    protected $table = 'speed_dials';

    protected $fillable = ['customer','sd_exten','sd_dest_type','sd_dest'];
}
