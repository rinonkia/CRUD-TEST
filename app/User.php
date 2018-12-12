<?php

namespace CRUDTEST;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CRUDTEST\Notifications\CustomPasswordReset;
use Illuminate\Auth\MustVerifyEmail;
use CRUDTEST\Notification\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

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
     * 現在のユーザー、もしくは引数で渡されたIDが管理者かどうかを返す
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
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }

    /**
     * メール確認通知の送信
     * 
     * @return void
     */
    public function sendEmailVerifycationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }
}
