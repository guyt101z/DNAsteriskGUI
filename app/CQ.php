<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CQ extends Model
{
    public function Queue(){
    	return $this->hasOne('App\Queue','cq','id');
    }

    protected $table = 'queues';

    protected $fillable = ['customer','q_name','q_members'];
}
