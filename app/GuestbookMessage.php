<?php

namespace AGarage;

use Illuminate\Database\Eloquent\Model;

class GuestbookMessage extends Model
{
    public function user() {
        return $this->belongsTo('AGarage\User');
    }

    public function parent() {
        return $this->belongsTo('AGarage\GuestbookMessage');
    }

    public function replies() {
        return $this->hasMany('AGarage\GuestbookMessage', 'parent_id');
    }
}
