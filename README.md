# yii2-atk

yii2 access token keeper

service http://github.com/trylife/atk

useage 

```php
    'components' => [
        'mp' => [
            'class' => 'trylife\atk\Atk',
            'atkBaseUrl' => 'http://host.docker.internal:8080',
            'appType' => "wxmp",
            'appId' => 'wxfdxxxxx',
            'basicAuthUser' => 'user',
            'basicAuthPass' => 'pass',
        ],
    ],
```