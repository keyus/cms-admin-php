<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'notice',
                'notice.content',
                'index',
                'calendar',
                'list',
                'detail',
                'article',
                'download',
            ],
            function ($view) {
                //全局导航
                $nav = DB::table('channel')
                    ->select('id', 'title', 'name')
                    ->where('isNav', 1)
                    ->where('show', 1)
                    ->orderBy('sort', 'desc')
                    ->get();
                $view->with('nav', $nav);
            }
        );
    }
}
