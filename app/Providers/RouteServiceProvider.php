<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string $namespace
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * @return void
     */
    public function map(): void
    {
        $this->mapWebRoutes();
    }

    /**
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/web.php'));
    }
}
