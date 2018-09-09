<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class myServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('throttle', function()
        {
            if(Cookie::get('throttle'))
            {
//                redirect()->to('/')->send();
                redirect()->back()->with('throttle', 'throttle')->send();
                Session::save();
                exit;
            }
            else
            {
                Cookie::queue('throttle', 'throttle', config('app.throttle_action'));
            }
        });
    }
}
