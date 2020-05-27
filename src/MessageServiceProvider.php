<?php

namespace Voilaf\MessageSystem;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider;
use Voilaf\MessageSystem\Console\MessageMakeCommand;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the nsq services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/message.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('message.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('message');
        }

        $this->mergeConfigFrom($source, 'message');

        // 注册命令
        if ($this->app->runningInConsole()) {
            $this->commands([
                MessageMakeCommand::class
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // 消息队列客户端
        $this->app->singleton('message-client', function () {
            return new \Voilaf\MessageSystem\Client\RrNatsClient();
        });
    }
}
