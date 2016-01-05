<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     *retrieve peer
     * 
     * @return  Peer
     */
    public function SIPPeer(){
        return $this->hasOne('App\Peer','portaluid');
    }

    /**
     * Retrieve customer object
     *
     * @return  Customer
     * 
     */
    public function Customer(){
        return $this->hasOne('App\Customer','id','customer');
    }

    /**
     * Retrieve user settings for follow me and forwarding
     *
     * @return  UserSettings object
     */
    public function UserSettings(){
        return $this->hasOne('App\UserSettings','user','id');
    }

    /**
     * check whether or not the user is an administrator for the customer
     * 
     * @return boolean
     */
    public function isAdmin(){
        if($this->attributes['permlevel']==1){
            return true;
        }else{
            return false;
        }
    }

    public function vmEnabled(){
        if($this->attributes['vmenabled']==1){
            return true;
        }else{
            return false;
        }
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'fullname', 'email', 'password','customer','peer','permlevel','vmenabled'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
