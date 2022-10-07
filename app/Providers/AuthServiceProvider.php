<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensCan([
            'admin_korporat' => 'All Access',
            'admin_unit' => 'Read Only',
            'operator_spbu' => 'Read Only',
            'pejabat' => 'Read Only',
            'pegawai' => 'Read Only',

        ]);
        Passport::setDefaultScope([
            'guest',
        ]);
        Passport::tokensExpireIn(now()->addDays(7));
        Passport::personalAccessTokensExpireIn(now()->addDays(7));

        //
    }
}
