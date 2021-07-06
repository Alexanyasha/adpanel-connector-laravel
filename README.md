# Adpanel Connector for Laravel

## Requirements
- PHP >= 7.2
- Laravel >= 5.8
 
## Description
This plugin send data of your Laravel project to Adpanel via REST API. You can adjust sending data.  


## Installation

### Composer
```
composer require ...
```

### Laravel

1. Run publishing command to copy config file to config folder.  
```  
php artisan vendor:publish --provider="DesignCoda/AdpanelConnector/AdpanelConnectorProvider" --tag="config" --force  
```  


2. Generate auth token with command  
```
php artisan adpanel:generate_token  
```  
and copy variable from console to .env file  


3. Edit `config/adpanel_connector.php` for your needs.  


4. Run for clear caching  
```
php artisan config:clear
php artisan route:clear
```


### Laravel

1. Запустите команду публикации файла с настройками в папку config  
```
php artisan vendor:publish --provider="DesignCoda/AdpanelConnector/AdpanelConnectorProvider" --tag="config" --force  
```

2. Сгенерируйте токен для авторизации командой  
```
php artisan adpanel:generate_token  
```
и скопируйте результат в файл .env.  


3. Отредактируйте файл `config/adpanel_connector.php` под ваши нужды.  


4. Очистите кэш командами
```
php artisan config:clear
php artisan route:clear
```


### Query parameters  
To receive data only valid auth token is required. But you can pass additional parameters such as ordering  
`from` - created_at column starting from Y-m-d inclusive. Must be valid date  
`to` - created_at column until Y-m-d inclusive. Must be valid date    
`order_by` - ordering column. Ignoring if column not exists. Must be string  
`desc` - uses only with `order_by`. Must be boolean  
  
### Параметры запросов  
Чтобы получить данные достаточно только валидного токена. Но также можно передавать дополнительные параметры для запроса, например, сортировку   
`from` - столбец created_at, начиная с указанной даты Y-m-d включительно. Должен быть валидной датой  
`to` - столбец created_at, до указанной даты Y-m-d включительно. Должен быть валидной датой  
`order_by` - столбец сортировки. Если столбец не существует, параметр игнорируется. Должен быть строкой  
`desc` - используется только в связке с `order_by`. Должен быть булевым  


### Response example  
```
Array
(
    [0] => Array
        (
            [name] => requests
            [columns] => Array
                (
                    [0] => id
                    [1] => utm
                    [2] => login
                    [3] => created_at
                )

            [errors] => Array
                (
                    [0] => Column «login» not exists in table «requests».
                )

            [data] => Illuminate\Support\Collection Object
                (
                    [items:protected] => Array
                        ( ... )
                )
        )
)        
```

### Пример ответа  
```
Array
(
    [0] => Array
        (
            [name] => requests
            [columns] => Array
                (
                    [0] => id
                    [1] => utm
                    [2] => login
                    [3] => created_at
                )

            [errors] => Array
                (
                    [0] => Столбец «login» в таблице «requests» не найден.
                )

            [data] => Illuminate\Support\Collection Object
                (
                    [items:protected] => Array
                        ( ... )
                )
        )
)        
```

## LICENSE
GNU GPLv3  
Copyright Alexanyasha