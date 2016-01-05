<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DID,App\User;
class Customer extends Model
{	

	
	/**
	 *Creates an on-the-fly DID using the customers callerid_num and returns a formatted string
	 * 
	 * @return String
	 */
	public function getDefaultCalleridAttribute(){
		$did = new DID(['did_did' => $this->attributes['cust_callerid_num']]);
		return '"'.$this->attributes['cust_callerid_name'].'" <'.$did->asterisk_formatted.'>';
	}

	public function getInternalContextAttribute(){
		return $this->attributes['id'].'_internal';
	}

	public function getIncomingContextAttribute(){
		return $this->attributes['id'].'_incoming';
	}

	/**
	 * @return App\User
	 */
	public function Users(){
		return $this->hasMany('App\User','customer');
	}

	public function DIDs(){
		return $this->hasMany('App\DID','did_customer');
	}

	public function Sounds(){
		return $this->hasMany('App\Sound','customer','id');
	}


	public function ConferenceBridges(){
		return $this->hasMany('App\ConferenceBridge','customer','id');
	}

	public function RingGroups(){
		return $this->hasMany('App\RingGroup','customer','id');
	}

	public function Queues(){
		return $this->hasMany('App\CQ','customer','id');
	}

	public function SpeedDials(){
		return $this->hasMany('App\SpeedDial','customer','id');
	}

	public function VoicemailBoxes(){
		return $this->hasMany('App\VoicemailBox','context','id');
	}
    
    protected $table = 'customers';

    protected $fillable = ['cust_name','cust_image','cust_area_code','cust_domain','cust_hash','cust_peer_limit','cust_call_limit','cust_callerid_name','cust_callerid_num'];

}
