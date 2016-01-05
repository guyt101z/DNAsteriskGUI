<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{

	public function User(){
		return $this->belongsTo('App\User','id','user');
	}
    
    protected $table = 'user_settings';

    protected $fillable = ['user','follow_enabled','follow_time_1','follow_number','follow_time_2','forward_enabled','forward_number'];
}
