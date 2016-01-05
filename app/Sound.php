<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{

	public function getRouteAttribute(){
		return "exten => ".$this->attributes['id'].",1,Set(RECORDFILE='/var/lib/asterisk/sounds/en/".$this->attributes['customer']."/".$this->attributes['recording_file']."')";
	}

	public function isInUse(){
		return false;
	}
    
    protected $table = 'sound_files';

    protected $fillable = ['customer','recording_name','recording_file'];
}