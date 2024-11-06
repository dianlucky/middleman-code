<?php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('free-user', function ($user = null) {
            return $user === null;
        });
        // Gate untuk memeriksa apakah pengguna sudah login
        Gate::define('is-login', function () {
            return auth()->check();
        });

        // Gate untuk memeriksa jika pengguna adalah superadmin
        Gate::define('isSuperadmin', function ($user) {
            return $user->role === 'superadmin'; // Mengembalikan true jika role adalah superadmin
        });
    }
}
