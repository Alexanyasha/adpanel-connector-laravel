<?php

namespace DesignCoda\AdpanelConnector;

use App\Http\Controllers\Controller;
use DesignCoda\AdpanelConnector\AdpanelConnectorRequest;

class AdpanelConnectorController extends Controller
{    
    public function index(AdpanelConnectorRequest $request) {
        return 'ok';
    }
}
