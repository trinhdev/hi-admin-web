<?php

namespace App\Providers;

use App\Helpers\statusCodeObject;
use Illuminate\Support\ServiceProvider;
use igaster\laravelTheme\Facades\Theme;
use Illuminate\Support\Facades\Validator;

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
        $this->alpha_underscore();
        $this->limit_icon_in_array();
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

    private function alpha_underscore() {
        Validator::extend('alpha_underscore', function ($attribute, $value, $parameters, $validator) {
            return preg_match("/^[A-Za-z_]*$/", $value);
            // return ucwords($value) === $value;
        });
    }

    private function limit_icon_in_array() {
        Validator::extend('limit_icon_in_array', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            return count(explode(",", $value)) <= (intval($data['iconsPerRow']) * intval($data['rowOnPage']));
        });
    }
}
