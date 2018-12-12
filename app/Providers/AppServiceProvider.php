<?php

namespace CRUDTEST\Providers;

use CRUDTEST\User;
use CRUDTEST\Policies\UserPolicy;
use CRUDTEST\Post;
use CRUDTEST\Policies\PostPolicy;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        /**
         * グローバル変数
         * 管理者のID番号を1とする
         */
        config(['admin_id' => 2]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
