<?php

namespace CRUDTEST;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CRUDTEST\Notifications\CustomPasswordReset;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lang'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 1対多のリレーション関係
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    /**
     * 現在のユーザー、もしくは引数で渡されたIDが管理者稼働羽化を返す
     * @param numbet $id User ID
     * @return boolean
     */
    public function isAdmin($id = null) {
        $id = ($id) ? $id : $this->id;
        return $id == config('admin_id');
    }
    /**
     * パスワードリセット通知の送信
     * 
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification()
    {
        $this->notify(new CostomPasswordReset($token));
    }
}
