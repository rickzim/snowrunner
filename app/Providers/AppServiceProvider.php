<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Filament\Support\View\Components\ModalComponent;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

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
        // app
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configureUrl();
        $this->configureVite();
        $this->configureLocale();
        $this->configureCurrency();
        // packages
        $this->configureFilament();
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(App::isProduction());
    }

    /**
     * Configure the dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configure the application's models.
     */
    private function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Model::shouldBeStrict(App::isLocal());

        Model::unguard();
    }

    /**
     * Configure the application's URL.
     */
    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Configure the application's Vite.
     */
    private function configureVite(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }

    /**
     * Configure the application's Locale.
     */
    private function configureLocale(): void
    {
        Number::useLocale(config('app.locale'));
    }

    /**
     * Configure the application's Currecy.
     */
    private function configureCurrency(): void
    {
        Number::useCurrency(config('app.currency', 'USD'));
    }

    private function configureFilament()
    {
        ModalComponent::closedByClickingAway(false);

        Table::configureUsing(function (Table $table) {
            $table
                ->deferFilters(false)
                ->deferColumnManager(false)
                ->defaultCurrency(config('app.currency', 'USD'));
        });
    }
}
