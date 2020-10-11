<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //status追加
    protected $fillable = ['content', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
