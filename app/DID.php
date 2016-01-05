<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DID extends Model
{
    
    /**
     *Formats the string for use as a SIP Peer Callerid
     * 
     * @return String
     */
    public function getAsteriskFormattedAttribute(){
    	return substr($this->attributes['did_did'],0,3).'-'.substr($this->attributes['did_did'],3,3).'-'.substr($this->attributes['did_did'],6,4);
    }

    /**
     *Formats the string for use in displaying to user
     * 
     * @return String
     */
    public function getDisplayFormattedAttribute(){
    	return '('.substr($this->attributes['did_did'],0,3).') '.substr($this->attributes['did_did'],3,3).'-'.substr($this->attributes['did_did'],6,4);
    }

    /**
     * get the destination for display on index
     * 
     * @return String
     */
    public function getFormattedDesttypeAttribute(){
        switch($this->attributes['dest_type']){
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
                return "Conference Bridge - ";
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

    /**
     *Returns a customer object assigned to the DID
     * 
     * @return  App\Customer
     */
    public function Customer(){
    	return $this->belongsTo('App\Customer');
    }

    public function Hint(){
    	return $this->hasOne('App\Hint');
    }

    protected $table = 'did';

    protected $fillable = ['did_did','did_customer','dest_type','dest_target'];
}
