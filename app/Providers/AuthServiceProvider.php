<?php

namespace App\Providers;

use App\Models\Field;
use App\Policies\FieldPolicy;
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
        Field::class => FieldPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-field', [FieldPolicy::class, 'view']);
        Gate::define('create-field', [FieldPolicy::class, 'create']);
        Gate::define('update-field', [FieldPolicy::class, 'update']);
        Gate::define('delete-field', [FieldPolicy::class, 'delete']);
    }
}
