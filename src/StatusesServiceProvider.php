<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager;

use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;

class StatusesServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    public function menu(): array
    {
        return [];
    }
}
