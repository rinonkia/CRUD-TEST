<?php

namespace CRUDTEST\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use CRUDTEST\User;
use CRUDTEST\Post;
use CRUDTEST\Policies\UserPolicy;
use CRUDTEST\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CRUDTEST\Model' => 'CRUDTEST\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
