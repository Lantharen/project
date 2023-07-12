<?php

declare(strict_types=1);


use App\Models\ReferralRule;
use App\Models\TradingSession;
use App\Models\Transaction;
use App\Orchid\Screens\HttpLog\HttpLogListScreen;
use App\Orchid\Screens\Offer\OfferEditScreen;
use App\Orchid\Screens\Offer\OfferListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Referral\ReferralEditScreen;
use App\Orchid\Screens\Referral\ReferralListScreen;
use App\Orchid\Screens\ReferralRules\ReferralRuleDetailsScreen;
use App\Orchid\Screens\ReferralRules\ReferralRuleListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\TradingSession\TradingSessionDetailsScreen;
use App\Orchid\Screens\TradingSession\TradingSessionListScreen;
use App\Orchid\Screens\Transaction\TransactionEditScreen;
use App\Orchid\Screens\Transaction\TransactionListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Platform > System > Transactions > Edit
Route::screen('transactions/{transaction}/edit', TransactionEditScreen::class)
    ->name('platform.systems.transactions.edit')
    ->breadcrumbs(fn(Trail $trail, Transaction $transaction) => $trail
            ->parent('platform.systems.transactions')
            ->push(__('Edit'), route('platform.systems.transactions.edit', $transaction)));

// Platform > System > Transactions > Create
Route::screen('transactions/create', TransactionEditScreen::class)
    ->name('platform.systems.transactions.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.transactions')
        ->push(__('Create'), route('platform.systems.transactions.create')));

// Platform > System > Transaction
Route::screen('/transactions', TransactionListScreen::class)
    ->name('platform.systems.transactions')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Transactions'), route('platform.systems.transactions')));

// Platform > System > Offers > Offer
Route::screen('offers/{offer}/edit', OfferEditScreen::class)
    ->name('platform.systems.offers.edit')
    ->breadcrumbs(function (Trail $trail, $offer) {
        return $trail
            ->parent('platform.systems.offers')
            ->push($offer->name, route('platform.systems.offers.edit', $offer));
    });

// Platform > System > Offers > Create
Route::screen('offers/create', OfferEditScreen::class)
    ->name('platform.systems.offers.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.offers')
        ->push(__('Create'), route('platform.systems.offers.create')));


// Platform > System > Offers
Route::screen('offers', OfferListScreen::class)
    ->name('platform.systems.offers')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Offers'), route('platform.systems.offers')));

// Platform > System > HTTP Logs
Route::screen('http-logs', HttpLogListScreen::class)
    ->name('platform.systems.http-logs')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('HTTP Logs'), route('platform.systems.http-logs')));

// Platform > System > Trading Sessions
Route::screen('trading-sessions', TradingSessionListScreen::class)
    ->name('platform.systems.trading-sessions')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Trading Sessions'), route('platform.systems.trading-sessions')));

// Platform > System > Trading Sessions Details
Route::screen('trading-sessions/{tradingSession}/details', TradingSessionDetailsScreen::class)
    ->name('platform.systems.trading-sessions.details')
    ->breadcrumbs(fn(Trail $trail, TradingSession $tradingSession) => $trail
        ->parent('platform.systems.trading-sessions')
        ->push(__('Trading Sessions Details'), route('platform.systems.trading-sessions.details', $tradingSession)));

// Platform > System > Referral Rules
Route::screen('referral-rules', ReferralRuleListScreen::class)
    ->name('platform.systems.referral-rules')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Referral Rules'), route('platform.systems.referral-rules')));

// Platform > System > Referrals > Referral
Route::screen('referrals/{referral}/edit', ReferralEditScreen::class)
    ->name('platform.systems.referrals.edit')
    ->breadcrumbs(function (Trail $trail, $referral) {
        return $trail
            ->parent('platform.systems.referrals')
            ->push('Edit', route('platform.systems.referrals.edit', $referral));
    });

// Platform > System > Referrals > Create
Route::screen('referrals/create', ReferralEditScreen::class)
    ->name('platform.systems.referrals.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.referrals')
        ->push(__('Create'), route('platform.systems.referrals.create')));

// Platform > System > Referrals
Route::screen('referrals', ReferralListScreen::class)
    ->name('platform.systems.referrals')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Referrals'), route('platform.systems.referrals')));
