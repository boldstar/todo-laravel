<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
    }

    public function rules() {
        return $this->hasMany('App\Rule');
    }
}
