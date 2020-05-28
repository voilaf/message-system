# message-system

PHP message-system client for Laravel && Lumen

基于Roadrunner + Nats

### 起因
PHP-Nats-Client社区版本超过2年未更新，稳定性很难得到保证

我们在Roadrunner中增加Service，使用官方Go-Nats-Client库，
PHP与Roadrunner通过GRPC通信，转发实现PHP-Nats发布、订阅功能

### Installation

`message-system` is available to add to your project via composer. Simply add the
following to your composer.json.

    {
        ...
        "require": {
            ...
            "voilaf/message-system": "^1.0"
        }
        ...
    }

or execute command.

    composer require voilaf/message-system

### Configuration

1、copy `config/message.php` to `project/config/message.php`

2、add your sub or pub subjects

3、add `APP_NAME` to .env

4、register MessageSystemProvider to project

    $this->app->register(\Voilaf\MessageSystem\MessageServiceProvider::class);

5、generate Subscribe class in `app\Subs` by executing command

    php artisan make:subscribe ExampleSubscribe


### Subscription （Laravel && Lumen）

```php
    // string $subject 发布事件名
    // string $data 发布信息
    // string $desc 事件描述
    app('message-client')->pub($subject, $data, $desc);
```
