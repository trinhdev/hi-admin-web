<?php

namespace App\Providers;

use App\Contract\Hi_FPT\PopupPrivateInterface;
use App\Repository\Hi_FPT\PopupPrivateRepository;
use App\Contract\Hi_FPT\PopupManageInterface;
use App\Repository\Hi_FPT\PopupManageRepository;


use Illuminate\Support\ServiceProvider;
// Auto Generate

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Bind Provider
        $this->app->bind(PopupPrivateInterface::class, PopupPrivateRepository::class);
        $this->app->bind(PopupManageInterface::class, PopupManageRepository::class);
    }

}
