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

1. Open config/app.php file and add provider 
```
DesignCoda\AdpanelConnector\AdpanelConnectorServiceProvider::class,
```

2. In aliases section of config/app.php add a Facade
```
'AdpanelConnector' => DesignCoda\AdpanelConnector\AdpanelConnectorFacade::class,
```

3. Get API key for your site

4. Configure .env as needed

```
...
```

5. Run for clear caching
```
php artisan config:clear
php artisan route:clear
```


### Laravel

1. Откройте файл config/app.php и добавьте строчку в секции providers
```
DesignCoda\AdpanelConnector\AdpanelConnectorServiceProvider::class,
```

2. В секции aliases того же файла config/app.php добавьте фасад
```
'AdpanelConnector' => DesignCoda\AdpanelConnector\AdpanelConnectorFacade::class,
```

3. Получите API-ключ для вашего сайта

4. Настройте файл .env (введите свой API-ключ)

```
...
```

5. Очистите кэш командами
```
php artisan config:clear
php artisan route:clear
```

## LICENSE
GNU GPLv3  
Copyright Alexanyasha