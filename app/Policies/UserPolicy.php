<?php

namespace CRUDTEST\Policies;

use CRUDTEST\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 編集と削除の認可を判断する。
     * 
     * @param  \CRUDTEST\User $user 現在ログインしているユーザー
     * @param \CRUDTEST\User $model 現在表示しているプロフィールページのユーザー
     * @return mixed
     */
    public function edit(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
