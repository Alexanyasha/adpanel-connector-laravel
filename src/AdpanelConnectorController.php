<?php

namespace DesignCoda\AdpanelConnector;

use App\Http\Controllers\Controller;
use DesignCoda\AdpanelConnector\AdpanelConnector;
use DesignCoda\AdpanelConnector\AdpanelConnectorRequest;

class AdpanelConnectorController extends Controller
{    
    public function index(AdpanelConnectorRequest $request) {
        $connector = new AdpanelConnector;

        $response = $connector->getData($request->all());
        return response()->json($response, 200);
    }
}
