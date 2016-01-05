<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    
    protected $connection = 'asterisk';

	protected $table = 'extensions';

	protected $fillable = ['context','exten','priority','app','appdata','customer'];

}
