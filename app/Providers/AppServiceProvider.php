<?php

namespace App\Providers;

use App\Models\CustomNotif;
use App\Models\Task;
use App\Observers\TaskObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Task::observe(TaskObserver::class);


        View::composer('site.pages.*', function ($view) {

            $allUnread = CustomNotif::where('read', false);

            $notifsCount = $allUnread->count();
            $notifs = $allUnread->latest()->take(4)->get();

            $view->with(['notifs' => $notifs, 'notifsCount' => $notifsCount]);
        });
    }
}
