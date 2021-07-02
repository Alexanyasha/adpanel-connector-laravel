<?php

namespace DesignCoda\AdpanelConnector;

use Illuminate\Support\Facades\Facade;

/**
 * Class AdpanelConnectorFacade
 * @package DesignCoda\AdpanelConnector
 */
class AdpanelConnectorFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'adpanel_connector';
    }
}