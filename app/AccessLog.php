<?php

namespace AGarage;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'client_ip',
        'user_agent',
        'resource',
        'exec_time'
    ];
}
