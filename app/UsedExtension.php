<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedExtension extends Model
{
    
    protected $table = 'used_extensions';

    protected $fillable = ['customer','extension'];
}
