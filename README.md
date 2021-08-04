# Adpanel Connector for Laravel

## Requirements
- PHP >= 7.2
- Laravel >= 5.8
 
## Description
This plugin send data of your Laravel project to Adpanel via REST API. You can adjust sending data.  


## Installation

### Composer
```
composer require designcoda/adpanel-connector-laravel
```

### Laravel

1. Run publishing command to copy config file to config folder.  
```  
php artisan vendor:publish --provider="DesignCoda\AdpanelConnector\AdpanelConnectorServiceProvider" --tag="adpanel-connector"  
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
php artisan config:cache  
php artisan route:clear
```  

5. Visit in browser `yoursite.url/adpanel_connector` to see response. If you add token `yoursite.url/adpanel_connector?token=token_from_env`, you will see authorized response with data.  


### Laravel

1. Запустите команду публикации файла с настройками в папку config  
```
php artisan vendor:publish --provider="DesignCoda\AdpanelConnector\AdpanelConnectorServiceProvider" --tag="adpanel-connector" --force  
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
php artisan config:cache  
php artisan route:clear
```  


5. Откройте в браузере `yoursite.url/adpanel_connector` чтобы увидеть отклик. Если добавить токен `yoursite.url/adpanel_connector?token=token_from_env`, можно увидеть авторизованный отклик с данными.  


## Query parameters  
To receive data only valid auth token is required. But you can pass additional parameters such as ordering  
`from` - created_at column starting from Y-m-d inclusive. Must be valid date  
`to` - created_at column until Y-m-d inclusive. Must be valid date    
`order_by` - ordering column. Ignoring if column not exists. Must be string  
`desc` - is used only with `order_by`. Must be boolean  
`filters` - fields for filtering query. Must be array (e.g. 
    filters['like']['utm']['utm_source']['campaign1', 'campaign2']) for field `utm_source` or `utm->utm_source` (JSON) like 'campaign1' or 'campaign2'  
    filters['equal']['utm']['utm_source']['campaign1', 'campaign2']) for field `utm_source` or `utm->utm_source` (JSON) 'campaign1' or 'campaign2'
)  
  
## Параметры запросов  
Чтобы получить данные достаточно только валидного токена. Но также можно передавать дополнительные параметры для запроса, например, сортировку   
`from` - столбец created_at, начиная с указанной даты Y-m-d включительно. Должен быть валидной датой  
`to` - столбец created_at, до указанной даты Y-m-d включительно. Должен быть валидной датой  
`order_by` - столбец сортировки. Если столбец не существует, параметр игнорируется. Должен быть строкой  
`desc` - используется только в связке с `order_by`. Должен быть булевым  
`filters` - поля для фильтрации запроса. Должны быть массивом (например, filters['utm']['utm_source']) для поля `utm_source` или `utm->utm_source` (JSON))  


## Response examples  
```  
{
    "status":"failure",
    "status_code":400,
    "message":"Bad Request",
    "errors": {
        "token": [
            "Auth token must be set in .env file. Run console command 'php artisan adpanel:generate_token' and edit your .env file or check published config file.",
            "Token is invalid."
        ]
    }
}
```  

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

## Примеры ответов  
```  
{
    "status":"failure",
    "status_code":400,
    "message":"Bad Request",
    "errors": {
        "token": [
            "Токен для авторизации должен быть указан в .env-файле. Запустите команду 'php artisan adpanel:generate_token' и внесите токен в ваш .env-файл или проверьте, опубликован ли файл конфигурации.",
            "Параметр «Токен» неверный."
        ]
    }
}
```  

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