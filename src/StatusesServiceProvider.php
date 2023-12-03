<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use MrVaco\HelperCode\Classes\Migrations;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class StatusesServiceProvider extends OrchidServiceProvider
{
    public static string $plugin_prefix = 'mr_vaco.statuses';

    public function boot(Dashboard $dashboard): void
    {
        Lang::addJsonPath(__DIR__ . '/../resources/lang');

        parent::boot($dashboard);

        $this->publish();
        $this->router();

        View::addLocation(__DIR__ . '/../resources/views');
    }

    public function menu(): array
    {
        return [
            Menu::make(__('Statuses'))
                ->icon('bs.collection')
                ->route(self::$plugin_prefix . '.list')
                ->active(self::$plugin_prefix . '.list')
                ->title(__('Statuses management'))
                ->sort(100),
        ];
    }

    public function router(): void
    {
        app('router')
            ->domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->group(__DIR__ . '/../routes/web.php');
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
