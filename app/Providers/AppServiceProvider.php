<?php

namespace App\Providers;

use App\Factory\Psr17Factory as FactoryPsr17Factory;
use Laravel\Passport\Passport;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Nyholm\Psr7\Factory\Psr17Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
        $loader = AliasLoader::getInstance();
        $loader->alias(Psr17Factory::class, FactoryPsr17Factory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Passport::hashClientSecrets();
    }
}
