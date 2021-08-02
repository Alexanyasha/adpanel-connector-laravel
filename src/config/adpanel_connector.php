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
            // Group of columns as one column
            'utm' => [
                'utm_source',
                'utm_campaign',
                'utm_banner',
                'utm_term',
                'utm_content',
                'utm_from',
            ],
            // If column's name differs
            'status' => 'rit_c2_status',
            'created_at',
        ],
    ],

    'auth_token' => env('ADPANEL_CONNECTOR_TOKEN', null),
];
