<?php

namespace DesignCoda\AdpanelConnector;

use DesignCoda\AdpanelConnector\AdpanelConnector;
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
            __DIR__.'/config/adpanel_connector_system.php', 'adpanel_connector'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/config/adpanel_connector.php' => config_path('adpanel_connector.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/adpanel.php');
    }

}
