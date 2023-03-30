<?php

namespace App\Providers;

use App\Composers\CartComposer;
use App\Composers\CategoryComposer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //s
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FacadesView::composer('client.layouts.app', CategoryComposer::class);
        FacadesView::composer('client.layouts.app', CartComposer::class);
    }
}
