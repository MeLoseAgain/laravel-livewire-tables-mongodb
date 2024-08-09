<?php

namespace KaitoSaikyo\LaravelLivewireTables;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Livewire\ComponentHookRegistry;
use KaitoSaikyo\LaravelLivewireTables\Commands\MakeCommand;
use KaitoSaikyo\LaravelLivewireTables\Features\AutoInjectRappasoftAssets;
use KaitoSaikyo\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;

class LaravelLivewireTablesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        AboutCommand::add('Rappasoft Laravel Livewire Tables', fn () => ['Version' => '3.2.4']);

        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables-kaito.php', 'livewire-tables-kaito'
        );

        // Load Default Translations
        $this->loadJsonTranslationsFrom(
            __DIR__.'/../resources/lang'
        );

        // Override if Published
        $this->loadJsonTranslationsFrom(
            $this->app->langPath('vendor/livewire-tables-kaito')
        );

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-tables-kaito');

        $this->consoleCommands();

        if (config('livewire-tables-kaito.inject_core_assets_enabled') || config('livewire-tables-kaito.inject_third_party_assets_enabled') || config('livewire-tables-kaito.enable_blade_directives')) {
            (new RappasoftFrontendAssets)->boot();
        }

    }

    public function consoleCommands()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../resources/lang' => $this->app->langPath('vendor/livewire-tables-kaito'),
            ], 'livewire-tables-translations');

            $this->publishes([
                __DIR__.'/../config/livewire-tables-kaito.php' => config_path('livewire-tables-kaito.php'),
            ], 'livewire-tables-config-kaito');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-tables-kaito'),
            ], 'livewire-tables-views-kaito');

            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/rappasoft/livewire-tables/js'),
                __DIR__.'/../resources/css' => public_path('vendor/rappasoft/livewire-tables/css'),
            ], 'livewire-tables-public');

            $this->commands([
                MakeCommand::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-tables-kaito.php', 'livewire-tables-kaito'
        );
        if (config('livewire-tables-kaito.inject_core_assets_enabled') || config('livewire-tables-kaito.inject_third_party_assets_enabled') || config('livewire-tables-kaito.enable_blade_directives')) {
            (new RappasoftFrontendAssets)->register();
            ComponentHookRegistry::register(AutoInjectRappasoftAssets::class);
        }
    }
}
