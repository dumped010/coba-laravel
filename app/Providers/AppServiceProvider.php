<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // untuk menggunakan template Bootstrap
        Paginator::useBootstrap();

        // untuk menggunakan Gate
        // Otorisasi user
        // Gate admin = aturan untuk seorang ADMIN
        Gate::define('admin', function(User $user) {
            return $user->is_admin;
        });
    }
}
