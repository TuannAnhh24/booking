<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    protected $repositories = [
        \App\Repositories\Contracts\CategoryRepository::class => \App\Repositories\Eloquent\CategoryRepositoryEloquent::class,
        \App\Repositories\Contracts\ImageRepository::class => \App\Repositories\Eloquent\ImageRepositoryEloquent::class,
        \App\Repositories\Contracts\LocationRepository::class => \App\Repositories\Eloquent\LocationRepositoryEloquent::class,
        \App\Repositories\Contracts\CharacteristicRepository::class => \App\Repositories\Eloquent\CharacteristicRepositoryEloquent::class,
        \App\Repositories\Contracts\ConvenientRepository::class => \App\Repositories\Eloquent\ConvenientRepositoryEloquent::class,
        \App\Repositories\Contracts\DestinationRepository::class => \App\Repositories\Eloquent\DestinationRepositoryEloquent::class,
        \App\Repositories\Contracts\SearchRepository::class => \App\Repositories\Eloquent\SearchRepositoryEloquent::class,
        \App\Repositories\Contracts\VariantRepository::class => \App\Repositories\Eloquent\VariantRepositoryEloquent::class,
        \App\Repositories\Contracts\RoomRepository::class => \App\Repositories\Eloquent\RoomRepositoryEloquent::class,
        \App\Repositories\Contracts\RoomListRepository::class => \App\Repositories\Eloquent\RoomListRepositoryEloquent::class,
        \App\Repositories\Contracts\ImageRepository::class => \App\Repositories\Eloquent\ImageRepositoryEloquent::class,
        \App\Repositories\Contracts\UserRepository::class => \App\Repositories\Eloquent\UserRepositoryEloquent::class,
        \App\Repositories\Contracts\UserDeviceRepository::class => \App\Repositories\Eloquent\UserDeviceRepositoryEloquent::class,
        \App\Repositories\Contracts\PromotionRepository::class => \App\Repositories\Eloquent\PromotionRepositoryEloquent::class,
        \App\Repositories\Contracts\ReviewRepository::class => \App\Repositories\Eloquent\ReviewRepositoryEloquent::class,
        \App\Repositories\Contracts\BannerRepository::class => \App\Repositories\Eloquent\BannerRepositoryEloquent::class,
        \App\Repositories\Contracts\RoomBookingRepository::class => \App\Repositories\Eloquent\RoomBookingRepositoryEloquent::class,
        \App\Repositories\Contracts\AnalyticRepository::class => \App\Repositories\Eloquent\AnalyticRepositoryEloquent::class,

    ];
    public function register() {}


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        foreach ($this->repositories as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }
}
