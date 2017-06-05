<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract{
    use Authenticatable;

    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = ['username', 'Name', 'Surname', 'email', 'password', 'imageUrl', 'role', 'approved'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks(){
        return $this->hasMany('App\Task', 'id');
    }

    public $timestamps = false;
    
}
