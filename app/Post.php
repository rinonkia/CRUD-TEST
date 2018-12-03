<?php

namespace CRUDTEST;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body',
    ];


    /**
     * 多対1のリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
