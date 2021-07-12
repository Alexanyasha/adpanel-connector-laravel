<?php

use Illuminate\Support\Facades\Route;

Route::any(config('adpanel_connector.route'), '\DesignCoda\AdpanelConnector\AdpanelConnectorController@index');
