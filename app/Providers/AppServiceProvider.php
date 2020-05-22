<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('datetime', function ($expression) {
            // list($date,$format) = explode(', ', $expression);
            dd(($expression));
            if(!$format) $format = 'Y-M-D H:i';
            return "<?php echo date($format,$expression) ?>";
        });
       

        View::composer(
            [
                'notice',
                'notice-content',
                'index',
                'calendar',
                'list',
                'detail',
                'news',
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
