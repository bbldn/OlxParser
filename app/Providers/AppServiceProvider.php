<?php

namespace App\Providers;

use App\Helpers\MainParserContext;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(MainParserContext::class, function () {
            return new MainParserContext(config('main_parser.olx_url'));
        });
    }
}
