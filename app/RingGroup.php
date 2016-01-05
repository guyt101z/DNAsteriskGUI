<?php

namespace App;

use Illuminate\Database\Eloquent\Model,App\Extension,Auth,App\User;

class RingGroup extends Model
{

	public function getType(){
		switch($this->rg_type){
			case '1':
				return 'Ring All';
			break;
			case '2':
				return 'Hunt';
			break;
		}
	}

	public function getExtenAttribute(){
		return Auth::user()->customer.'_rg_'.$this->id;
	}

	public function getDefaultApp(){
		switch($this->rg_dest_type){
			case 'hangup':
                return 'Hangup';
            break;
            case 'forward':
                return 'Dial';
            break;
            case 'extension':
                return 'Goto';
            break;
            case 'ivr':
                return 'Goto';
            break;
            case 'ringgroup':
                return 'Goto';
            break;
            case 'schedule':
                return 'Goto';
            break;
            case 'confbridge':
                return 'Goto';
            break;
            case 'voicemail':
                return 'Voicemail';
            break;
            case 'queue':
                return 'Queue';
            break;
            case 'busy':
                return 'Busy';
            break;
            default:
                return 'Hangup';
            break;
		}
	}

	public function getDefaultAppData(){
		switch($this->rg_dest_type){
			case 'hangup':
                return 'Hangup';
            break;
            case 'forward':
                return '${TRUNK1}/'.$this->rg_dest;
            break;
            case 'extension':
                return '';
            break;
            case 'ivr':
                return '';
            break;
            case 'ringgroup':
                return '';
            break;
            case 'schedule':
                return '';
            break;
            case 'confbridge':
                return '';
            break;
            case 'voicemail':
                return '';
            break;
            case 'queue':
                return '';
            break;
            case 'busy':
                return '';
            break;
            default:
                return '';
            break;
		}
	}

	public function buildDialPlan(){

		Extension::where('customer',Auth::user()->customer)->where('context',Auth::user()->Customer->internal_context)->where('exten',$this->exten)->delete();

		switch($this->getType()){
			case 'Ring All':
				$Ring = array();
				$tmp = json_decode($this->rg_members,true);
				foreach($tmp as $u){
					array_push($Ring,'SIP/'.User::find($u)->SIPPeer->name);
				}
				Extension::create([
					'context' => Auth::user()->Customer->internal_context,
					'exten' => $this->exten,
					'priority' => 1,
					'app' => 'Dial',
					'appdata' => implode('&',$Ring).','.$this->rg_time,
					'customer' => Auth::user()->customer
				]);
				Extension::create([
					'context' => Auth::user()->Customer->internal_context,
					'exten' => $this->exten,
					'priority' => 2,
					'app' => $this->getDefaultApp(),
					'appdata' => $this->getDefaultAppData(),
					'customer' => Auth::user()->customer
				]);
			break;
			case 'Hunt':

			break;
		}

	}

	public function isInUse(){
		$Extension = Extension::where('customer',Auth::user()->customer)->where('appdata','LIKE','%'.Auth::user()->customer.'_rg_'.$this->id.'%')->first();
		if($Extension){
			return true;
		}
		return false;
	}

	/**
	 * Overrides eloquent delete method
	 * 
	 */
	public function delete(){

		parent::delete();

		Extension::where('customer',Auth::user()->customer)->where('context',Auth::user()->Customer->internal_context)->where('exten',$this->exten)->delete();
		
	}
    
    protected $table = 'ring_groups';

    protected $fillable = ['customer','rg_name','rg_type','rg_time','rg_members','rg_dest_type','rg_dest'];
}
