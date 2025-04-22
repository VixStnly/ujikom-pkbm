<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NotificationGuru;
use Illuminate\Support\Facades\Auth;

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
 
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = NotificationGuru::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
    
                $unreadCount = NotificationGuru::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
    
                $view->with('notifications', $notifications);
                $view->with('unreadCount', $unreadCount);
            }
        });
    }
    
}
