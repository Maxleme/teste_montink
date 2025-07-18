<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\ProdutoRepository;
use App\Interfaces\CupomRepositoryInterface;
use App\Repositories\CupomRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProdutoRepositoryInterface::class,
            ProdutoRepository::class
        );
        
        $this->app->bind(
            CupomRepositoryInterface::class,
            CupomRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
