<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\View\Components\ApplicationLayout;
use App\Models\DataVerification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('application-layout', ApplicationLayout::class);

        // View Composer untuk mengatur layout berdasarkan role
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

                // Set layout berdasarkan role
                if ($user->role === 'super-admin') {
                    $view->with('layout', 'layouts.superadmin-master');

                    // Share notification data for superadmin views
                    $pendingVerifications = DataVerification::where('status', 'pending')
                        ->with('admin')
                        ->orderBy('created_at', 'desc')
                        ->get();

                    $pendingVerificationCount = $pendingVerifications->count();

                    $view->with('pendingVerifications', $pendingVerifications);
                    $view->with('pendingVerificationCount', $pendingVerificationCount);
                } elseif ($user->role === 'administrator') {
                    $view->with('layout', 'layouts.admin-master');
                } elseif ($user->role === 'operator') {
                    $view->with('layout', 'layouts.operator-master');
                } else {
                    $view->with('layout', 'layouts.app'); // default
                }
            } else {
                $view->with('layout', 'layouts.app'); // default untuk guest
            }
        });
    }
}
