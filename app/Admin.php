<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'branch_office_id', 'avatar', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function office()
    {
        return $this->belongsTo('App\BranchOffice', 'branch_office_id');
    }
}
