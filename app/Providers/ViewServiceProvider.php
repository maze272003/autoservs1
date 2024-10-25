<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = Message::where('email', Auth::user()->email)
                                       ->where('read', false)
                                       ->count();
                $view->with('unreadCount', $unreadCount);
            }
        });
    }

    public function register()
    {
        //
    }
}
