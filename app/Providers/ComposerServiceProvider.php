<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        /*
         * Composer for left column in partner
         */
        View::composer(
            'partner.includes.left_column',
            'App\Http\ViewComposers\Partner\LeftColumnComposer'
        );

        /*
         * Composer for left column in partner
         */
        View::composer(
            'admin.includes.left_column',
            'App\Http\ViewComposers\Admin\LeftColumnComposer'
        );

        /*
         * Composer for partner header
         */
        View::composer(
            'partner.includes.header',
            'App\Http\ViewComposers\Partner\HeaderComposer'
        );

        View::composer(
            ['client.includes.header', 'client.includes.form_themes'],
            'App\Http\ViewComposers\Client\HeaderComposer'
        );

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
