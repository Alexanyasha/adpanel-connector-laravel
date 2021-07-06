<?php

namespace DesignCoda\AdpanelConnector;

use App\Http\Controllers\Controller;
use DesignCoda\AdpanelConnector\AdpanelConnector;
use DesignCoda\AdpanelConnector\AdpanelConnectorRequest;

class AdpanelConnectorController extends Controller
{    
    public function index(AdpanelConnectorRequest $request) {
        $connector = new AdpanelConnector;

        return '<pre>' . print_r($connector->getData($request->all()), true) . '</pre>';
    }
}
