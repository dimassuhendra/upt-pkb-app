<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        // Mendefinisikan hak akses petugas
        Gate::define('akses-petugas', function (User $user) {
            return $user->role === 'petugas';
        });

        // Mendefinisikan hak akses admin
        Gate::define('akses-admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}