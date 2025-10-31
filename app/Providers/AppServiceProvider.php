<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //
        User::observe(UserObserver::class);

        // Prevenir las conulstas del tipo N+1
        Model::preventLazyLoading();

        // Cargar el locale español
        Number::useLocale('es'); // Usa formato español: 1.381 en vez de 1,381

        // // Registrar plugin de Chart.js (datalabels) para Filament
        // FilamentAsset::register([
        //     Js::make('chart-js-plugins', Vite::asset('resources/js/filament-chart-js-plugins.js'))->module(),
        // ]);

        // Acceso por protocolo seguro en producción
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}