<?php

return [

    'error' => [
        'filter' => 'Ошибка в фильтрах.',
        'no_column' => 'Столбец «:column» в таблице «:table» не найден.',
        'no_columns' => 'Столбцы «:columns» в таблице «:table» не найдены.',
    ],

    'label' => [
        'from' => 'От',
        'desc' => 'По убыванию',
        'order_by' => 'Порядок',
        'to' => 'До',
        'token' => 'Токен',
    ],

    'validation' => [
        'after_or_equal'       => 'Параметр «:attribute» должен быть больше или равен параметру «:date».',
        'boolean'              => 'Параметр «:attribute» должен быть true или false.',
        'date'                 => 'Параметр «:attribute» должен быть корректной датой.',
        'in'                   => 'Параметр «:attribute» неверный.',
        'required'             => 'Параметр «:attribute» обязателен.',
        'set_token'            => 'Токен для авторизации должен быть указан в .env-файле. Запустите команду \'php artisan adpanel:generate_token\' и внесите токен в ваш .env-файл или проверьте, опубликован ли файл конфигурации.',
        'string'               => 'Параметр «:attribute» должен быть строкой.',
    ],

];
