<?php

namespace App\Providers;

use App\Helpers\statusCodeObject;
use Illuminate\Support\ServiceProvider;
use igaster\laravelTheme\Facades\Theme;

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
        $this->app->singleton('statusCodeObject', function ($app) {
            return new statusCodeObject;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        require __DIR__ . '/../Helpers/platform_helper.php';

        $this->boot_theme();
    }
    private function boot_theme()
    {

        //set Themes and viewPath
        \Theme::set(config('platform_config.current_theme'));

        // path to view blade template.
        \Theme::find(config('platform_config.current_theme'))->viewsPath = config('platform_config.current_theme');

        // path to css, fonts, js, image folder
        \Theme::find(config('platform_config.current_theme'))->themesPath = config('platform_config.current_theme');

        // path to upload folder
        \Theme::find(config('platform_config.current_theme'))->assetPath = "";
    }
}
