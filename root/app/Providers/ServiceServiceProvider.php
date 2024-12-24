<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        \App\Services\Contracts\CategoryServiceInterface::class => \App\Services\Web\CategoryService::class,
        \App\Services\Contracts\VariantServiceInterface::class => \App\Services\Web\VariantService::class,
        \App\Services\Contracts\RoomServiceInterface::class => \App\Services\Web\RoomService::class,
        \App\Services\Contracts\RoomListServiceInterface::class => \App\Services\Web\RoomListService::class,
        \App\Services\Contracts\LocationServiceInterface::class => \App\Services\Web\LocationService::class,
        \App\Services\Contracts\CharacteristicServiceInterface::class => \App\Services\Web\CharacteristicService::class,
        \App\Services\Contracts\ConvenientServiceInterface::class => \App\Services\Web\ConvenientService::class,
        \App\Services\Contracts\DestinationServiceInterface::class => \App\Services\Web\DestinationService::class,
        \App\Services\Contracts\SearchClientServiceInterface::class => \App\Services\Web\SearchClientService::class,
        \App\Services\Contracts\VariantServiceInterface::class => \App\Services\Web\VariantService::class,
        \App\Services\Contracts\UserServiceInterface::class => \App\Services\Web\UserService::class,
        \App\Services\Contracts\UserDeviceServiceInterface::class => \App\Services\Web\UserDeviceService::class,
        \App\Services\Contracts\PromotionServiceInterface::class => \App\Services\Web\PromotionService::class,
        \App\Services\Contracts\ReviewServiceInterface::class => \App\Services\Web\ReviewService::class,
        \App\Services\Contracts\BannerServiceInterface::class => \App\Services\Web\BannerService::class,
        \App\Services\Contracts\DashboardServiceInterface::class => \App\Services\Web\DashboardService::class,
        \App\Services\Contracts\RoomBookingServiceInterface::class => \App\Services\Web\RoomBookingService::class,
        \App\Services\Contracts\AnalyticServiceInterface::class => \App\Services\Web\AnalyticService::class

    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->services as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }
}
