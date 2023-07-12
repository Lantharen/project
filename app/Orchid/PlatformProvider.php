<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param  Dashboard  $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Get Started')
                ->icon('bs.book')
                ->title('Navigation')
                ->route(config('platform.index')),

            Menu::make('Offers')
                ->icon('bs.file-earmark-bar-graph')
                ->route('platform.systems.offers'),

            Menu::make(__('Transactions'))
                ->icon('shuffle')
                ->route('platform.systems.transactions'),

            Menu::make(__('Trading Sessions'))
                ->icon('receipt')
                ->route('platform.systems.trading-sessions'),

            Menu::make('Referrals')
                ->slug('sub-menu')
                ->icon('code')
                ->list([
                    Menu::make('Referral Rule')->icon('bs.bag')
                        ->route('platform.systems.referral-rules'),
                    Menu::make('Referral')->icon('bs.person-bounding-box')
                        ->route('platform.systems.referrals'),
                ]),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make(__('HTTP Logs'))
                ->icon('bs.globe')
                ->route('platform.systems.http-logs')
                ->title(__('Miscellaneous')),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
