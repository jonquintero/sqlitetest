<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function boot()
    {
        View::composer('admin.comments.form', 'App\Http\ViewComposers\PostComposer');
        View::composer('auth.register', 'App\Http\ViewComposers\RoleComposer');
    }
}
