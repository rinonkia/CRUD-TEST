<?php

namespace CRUDTEST\Policies;

use CRUDTEST\User;
use CRUDTEST\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * 管理者は全ての行動を認可する
     * 
     * @param $user
     * @param $ability
     * 
     * @return mixed
     */
    public function before($user, $ability)
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * 編集と削除の認可を判断する
     * 
     * @param  \App\User $user 現在ログインしているユーザー
     * @param  \App\Post $post 現在表示している投稿
     * 
     * @return mixed
     */
    public function edit(User $user, Post $post)
    {
        return $user->id == $post->user_id;
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
