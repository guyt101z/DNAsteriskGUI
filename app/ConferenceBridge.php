<?php

namespace App;

use Illuminate\Database\Eloquent\Model,App\Extension,App\UsedExtension,Auth,App\Http\Controllers\AsteriskController;

class ConferenceBridge extends Model
{

	public function getAuth(){
		if($this->attributes['conf_auth']){
			return $this->attributes['conf_auth'];
		}else{
			return 'None';
		}
	}

	public function rebuildConference(){
		//move to rebuild method on model
        $Extensions = Extension::where('app','ConfBridge')->where('appdata',Auth::user()->customer.'_'.$this->conf_name)->where('customer',Auth::user()->customer)->get();
        foreach($Extensions as $Extension){
            Extension::where('context',$Extension->context)->where('exten',$Extension->exten)->where('customer',Auth::user()->customer)->delete();
            AsteriskController::genRoute($Extension->context,$Extension->exten,'confbridge',$this->id);
        }
	}

	public function delete(){

		parent::delete();

		$Extensions = Extension::where('app','ConfBridge')->where('appdata',Auth::user()->customer.'_'.$this->conf_name)->where('customer',Auth::user()->customer)->get();
        foreach($Extensions as $Extension){
            if($Extension->context == Auth::user()->Customer->internal_context){
                UsedExtension::where('customer',Auth::user()->customer)->where('extension',$Extension->exten)->delete();
            }
            Extension::where('context',$Extension->context)->where('exten',$Extension->exten)->where('customer',Auth::user()->customer)->delete();
        }
	}
    
    protected $table = 'conf_bridge';

    protected $fillable = ['customer','conf_name','conf_auth'];
}
