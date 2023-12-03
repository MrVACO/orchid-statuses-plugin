<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager;

use MrVaco\HelperCode\Classes\Migrations;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;

class StatusesServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        $this->publish();
    }

    public function menu(): array
    {
        return [];
    }

    protected function publish()
    {
        if (!$this->app->runningInConsole())
        {
            return;
        }

        $this->publishes([
            __DIR__ . '/../stubs/create_statuses_table.stub'        => Migrations::getMigrationFileName('create_statuses_table.php'),
            __DIR__ . '/../stubs/create_statuses_groups_table.stub' => Migrations::getMigrationFileName('create_statuses_groups_table.php'),
            __DIR__ . '/../stubs/fill_statuses.stub'                => Migrations::getMigrationFileName('fill_statuses.php'),
        ], 'migrations');
    }
}
