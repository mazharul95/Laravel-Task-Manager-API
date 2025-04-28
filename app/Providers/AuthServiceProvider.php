<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));

         // Optional: define scopes
    Passport::tokensCan([
        'create-tasks'   => 'Create new tasks',
        'edit-tasks'     => 'Edit existing tasks',
        'delete-tasks'   => 'Delete tasks',
        'manage-projects'=> 'Create/edit/delete projects',
    ]);
    
    }
}
