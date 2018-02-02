<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Carbon\Carbon::setLocale('zh');
        User::observe(UserObserver::class);
        Reply::observe(ReplyObserver::class);
        Topic::observe(TopicObserver::class);
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        \Horizon::auth(function ($request) {
            // 是否是站长
            return \Auth::user()->hasRole('Founder');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //用户切换工具
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
