<?php

namespace App\Providers;

use App\Contracts\ChannelServiceContract;
use App\Contracts\MessageServiceContract;
use App\Models\Channel;
use App\Models\Message;
use App\Observers\ChannelObserver;
use App\Observers\MessageObserver;
use App\Services\ChannelService;
use App\Services\MessageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ChannelServiceContract::class, ChannelService::class);
        $this->app->singleton(MessageServiceContract::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Channel::observe(ChannelObserver::class);
        Message::observe(MessageObserver::class);
    }
}
