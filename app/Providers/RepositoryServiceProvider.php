<?php

namespace App\Providers;

use App\Contract\Hi_FPT\PopupPrivateInterface;
use App\Repository\Hi_FPT\PopupPrivateRepository;

use App\Contract\Hi_FPT\PopupManageInterface;
use App\Repository\Hi_FPT\PopupManageRepository;

use App\Contract\Hi_FPT\BannerManageInterface;
use App\Repository\Hi_FPT\BannerManageRepository;

use App\Contract\Hi_FPT\ResetPasswordWrongInterface;
use App\Repository\Hi_FPT\ResetPasswordWrongRepository;

use App\Contract\Hi_FPT\FtelPhoneInterface;
use App\Repository\Hi_FPT\FtelPhoneRepository;

use App\Contract\Hi_FPT\SectionLogInterface;
use App\Repository\Hi_FPT\SectionLogRepository;

use App\Contract\Hi_FPT\DeeplinkInterface;
use App\Repository\Hi_FPT\DeeplinkRepository;

use App\Contract\Hi_FPT\ScreenInterface;
use App\Repository\Hi_FPT\ScreenRepository;

use App\Contract\Hi_FPT\BehaviorInterface;
use App\Repository\Hi_FPT\BehaviorRepository;

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
        $this->app->bind(BannerManageInterface::class, BannerManageRepository::class);
        $this->app->bind(ResetPasswordWrongInterface::class, ResetPasswordWrongRepository::class);
        $this->app->bind(FtelPhoneInterface::class, FtelPhoneRepository::class);
        $this->app->bind(SectionLogInterface::class, SectionLogRepository::class);
        $this->app->bind(DeeplinkInterface::class, DeeplinkRepository::class);
        $this->app->bind(ScreenInterface::class, ScreenRepository::class);
        $this->app->bind(BehaviorInterface::class, BehaviorRepository::class);
    }

}
