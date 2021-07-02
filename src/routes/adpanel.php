<?php

use Illuminate\Support\Facades\Route;

Route::get(config('adpanel_connector.route'), '\DesignCoda\AdpanelConnector\AdpanelConnectorController@index');
