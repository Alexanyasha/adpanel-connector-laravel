<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Adpanel Connector
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Adpanel Connector plugin.
    |
    */

    // Exporting tables
    'tables' => [
        // DB table name
        'requests' => [
            // DB columns to export
            'id',
            'utm',
            'created_at',
        ],
    ],

    'auth_token' => env('ADPANEL_CONNECTOR_TOKEN', null),
];
