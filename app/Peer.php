<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peer extends Model
{

	public function VoicemailBox(){
		return $this->hasOne('App\VoicemailBox','sip_buddy_id','id');
	}

	public function getHint(){
		return str_replace('_','',$this->attributes['name']);
	}

	public function User(){
		return $this->hasOne('App\User','id','portaluid');
	}

	/**
	 * generate a unique secret for this account
	 * 
	 * @return String PeerSecret
	 */
	public static function genSecret(){
		
		$pwChars = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz!@#&^');

		$Password = '';
		for($i=0;$i<10;$i++){
			$Password .= $pwChars[rand(0,strlen($pwChars)-1)];
		}
		return $Password;
	}

	protected $connection = 'asterisk';

	protected $table = 'sip_buddies';

	protected $fillable = ['name','callerid','defaultuser','secret','context','mailbox','call-limit','hintid','portaluid','peertype','vmrow'];

}
