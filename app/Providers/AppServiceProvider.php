<?php

namespace App\Providers;

use App\Models\Offer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Models\User as UserOrchid;
use Orchid\Support\Facades\Dashboard;

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
        $this->useOwnUserModel();

        Route::model('offer', Offer::class);
        Route::model('transaction', Transaction::class);
    }

    /**
     * Use the own user model instead of Orchid`s.
     *
     * @return void
     */
    protected function useOwnUserModel():void
    {
        Dashboard::useModel(UserOrchid::class, User::class);
    }
}
