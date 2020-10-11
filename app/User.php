<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password',];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];
    
    public function tasks()
    {
        // 大文字にしないとエラー出る
        return $this->hasMany(Task::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('tasks');
    }
}
