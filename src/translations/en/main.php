<?php

return [

    'error' => [
        'filter' => 'Filter error.',
        'no_column' => 'Column :column not exists in table :table.',
        'no_columns' => 'Columns :columns not exists in table :table.',
    ],

    'label' => [
        'from' => 'From',
        'desc' => 'Desc',
        'order_by' => 'Order by',
        'to' => 'To',
        'token' => 'Token',
    ],

    'validation' => [
        'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
        'boolean'              => 'The :attribute field must be true or false.',
        'date'                 => 'The :attribute is not a valid date.',
        'in'                   => ':attribute is invalid.',
        'required'             => 'The :attribute is required.',
        'set_token'            => 'Auth token must be set in .env file. Run console command \'php artisan adpanel:generate_token\' and edit your .env file or check published config file.',
        'string'               => 'The :attribute must be a string.',
    ],

];
