<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\ProvinceRepository;
use App\Repositories\Contracts\ProvinceRepositoryInterface;
use App\Repositories\Eloquents\HotelRepository;
use App\Repositories\Contracts\HotelRepositoryInterface;
use App\Repositories\Eloquents\ImageRepository;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Eloquents\BookingRepository;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Eloquents\BookingDetailRepository;
use App\Repositories\Contracts\BookingDetailRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BookingDetailRepositoryInterface::class, BookingDetailRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            config('user.type_hotel') => 'App\Models\Hotel',
            config('user.type_room') => 'App\Models\Room',
        ]);
    }
}
