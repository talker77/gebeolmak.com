<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Forum;
use App\Policies\BlogPolicy;
use App\Policies\ForumPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Blog::class => BlogPolicy::class,
        Forum::class => ForumPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::before(function (User $user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
