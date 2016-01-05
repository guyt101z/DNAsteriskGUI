<?php

namespace App;

use Illuminate\Database\Eloquent\Model,Auth,App\Extension;

class Queue extends Model
{

	public function Members(){
		return $this->hasMany('App\QueueMember','queue_name','name');
	}

	public function isInUse(){
		$Extension = Extension::where('customer',Auth::user()->customer)->where('app','Queue')->where('appdata',$this->name)->first();
		if($Extension){
			return true;
		}
		return false;
	}

    protected $primaryKey = 'name';

    protected $connection = 'asterisk';

    protected $table = 'queue_table';

    protected $fillable = ['name','musiconhold','strategy','timeout','retry','cq'];
}
