<?php

namespace AGarage;

use Illuminate\Database\Eloquent\Model;

class SocialiteUser extends Model
{
    protected $fillable = [
        'id', 'type', 'email', 'name', 'nickname', 'token', 'secret', 'raw'
    ];

    public function user() {
        return $this->belongsTo('AGarage\User');
    }

    public function setRawUser(array $raw) {
        $this->raw = json_encode($raw);
    }

    public function createUser() {
        return User::create([
            'nickname' => $this->nickname,
            'name' => $this->name,
            'avatar' => $this->avatar
        ]);
    }
}
