<?php

namespace App\Orchid\Layouts\HttpLog;

use App\Orchid\Filters\{IpAddressFilter, PathFilter, RelationalUserNameFilter};
use Orchid\Screen\Layouts\Selection;

class HttpLogFilterLayout extends Selection
{
    /** {@inheritDoc} */
    public function filters(): iterable
    {
        return [
            RelationalUserNameFilter::class,
            IpAddressFilter::class,
            PathFilter::class,
        ];
    }
}
