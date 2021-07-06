<?php

namespace DesignCoda\AdpanelConnector;

use Artisan;
use DesignCoda\AdpanelConnector\AdpanelConnector;
use DesignCoda\AdpanelConnector\Commands\GenerateToken;
use Illuminate\Support\ServiceProvider;

class AdpanelConnectorServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('adpanel_connector', function () {
            return new AdpanelConnector;
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/adpanel_connector_system.php', 'adpanel_connector'
        );

        $this->commands([
            GenerateToken::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__ . '/config/adpanel_connector.php' => config_path('adpanel_connector.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes/adpanel.php');

        $this->loadTranslationsFrom(__DIR__ . '/translations', 'adpanel_connector');

        try {
        
            Artisan::call('vendor:publish', [
                '--provider' => 'DesignCoda/AdpanelConnector/AdpanelConnectorProvider', 
                '--tag' => 'config',
                '--force' => true,
            ]);
        
        } catch (\Exception $e) {
            logger($e->getFile() . ' ' . $e->getLine() . ': ' . $e->getMessage());
        }
    }

}
