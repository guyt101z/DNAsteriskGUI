<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueMember extends Model
{
    
    protected $primaryKey = 'uniqueid';

    protected $connection = 'asterisk';

    protected $table = 'queue_member_table';

    protected $fillable = ['membername','queue_name','interface','penalty'];
}
