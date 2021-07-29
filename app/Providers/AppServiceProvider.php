<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'User',
        ];
        foreach ($models as $model) {
            $contracts = 'App\Repositories\Contracts\\' . $model . 'RepositoryInterface';
            $eloquents = 'App\Repositories\Eloquents\\' . $model . 'Repository';
            $this->app->bind($contracts, $eloquents);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
