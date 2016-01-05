<?php

namespace App;

use Illuminate\Database\Eloquent\Model,App\Peer;

class VoicemailBox extends Model
{

	public function getRelatedUserAttribute(){
		return Peer::find($this->sip_buddy_id)->User->fullname ?? $this->mailbox_name ?? 'Unkown';
	}

	protected $connection = 'asterisk';

	protected $table = 'voicemail';

	protected $primaryKey = 'uniqueid';

	protected $fillable = ['customer_id','context','mailbox','password','fullname','email','attach','delete','sip_buddy_id'];

}
