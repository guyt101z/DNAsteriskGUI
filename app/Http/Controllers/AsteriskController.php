<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller,Auth,App\Extension,App\ConferenceBridge;

class AsteriskController extends Controller
{
    
    public static function genRoute($context,$exten,$type,$dest){
    	switch($type){
            case 'hangup':
                return "Hangup";
            break;
            case 'forward':
                return "Forward - ".$this->attributes['dest_target'];
            break;
            case 'extension':
                return "Extenstion - ";
            break;
            case 'ivr':
                return "Auto Attendant - ";
            break;
            case 'ringgroup':
                return "Ring Group - ";
            break;
            case 'schedule':
                return "Schedule - ";
            break;
            case 'confbridge':
            	$Conf = ConferenceBridge::find($dest);
            	Extension::create([
	                'context' => $context,
	                'exten' => $exten,
	                'priority' => '1',
	                'app' => 'Answer',
	                'appdata' => '',
	                'customer' => Auth::user()->customer
	            ]);
	            $priority=2;
	            if($Conf->conf_auth){
	                Extension::create([
	                    'context' => $context,
	                    'exten' => $exten,
	                    'priority' => $priority,
	                    'app' => 'Authenticate',
	                    'appdata' => $Conf->conf_auth,
	                    'customer' => Auth::user()->customer
	                ]);
	                $priority++;
	            }
	            Extension::create([
	                'context' => $context,
	                'exten' => $exten,
	                'priority' => $priority,
	                'app' => 'ConfBridge',
	                'appdata' => Auth::user()->customer.'_'.$Conf->conf_name,
	                'customer' => Auth::user()->customer
	            ]);
            break;
            case 'voicemail':
                return "Voicemail - ";
            break;
            case 'queue':
                return "Queue - ";
            break;
            case 'busy':
                return "Busy";
            break;
            default:
                return "Error";
            break;
        }
        
    }

    protected function syncUsedExtensions(){
    	//delete used and relearn
    }
}
