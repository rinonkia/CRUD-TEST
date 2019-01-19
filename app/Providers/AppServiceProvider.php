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
         * .envファイルの(APP_ENV=production)のとき
         */
        if(\App::environment('production')) {
            \URL::forceScheme('https');
        }

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
