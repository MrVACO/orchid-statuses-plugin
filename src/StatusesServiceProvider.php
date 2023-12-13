<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use MrVaco\HelperCode\Classes\Migrations;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use MrVaco\OrchidStatusesManager\Observers\StatusObserver;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class StatusesServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        Lang::addJsonPath(__DIR__ . '/../resources/lang');

        $dashboard->registerPermissions(StatusEnum::permissions());
        parent::boot($dashboard);

        $this->publish();
        $this->router();

        View::addNamespace(StatusEnum::prefixPlugin, __DIR__ . '/../resources/views');
        StatusModel::observe(StatusObserver::class);
    }

    public function menu(): array
    {
        $title = __('Statuses management');

        return [
            Menu::make(__('Statuses'))
                ->icon('bs.check2-square')
                ->permission(StatusEnum::statusView)
                ->route(StatusEnum::statusView)
                ->active(StatusEnum::prefixStatus . '*')
                ->title($title)
                ->sort(100),

            Menu::make(__('Status groups'))
                ->icon('bs.collection')
                ->permission([StatusEnum::groupView])
                ->route(StatusEnum::groupView)
                ->active(StatusEnum::prefixGroup . '*')
                ->title(auth()->user()->hasAccess(StatusEnum::statusView) ? null : $title)
                ->sort(101),
        ];
    }

    public function router(): void
    {
        app('router')
            ->domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->group(__DIR__ . '/../routes/web.php');
    }

    protected function publish(): void
    {
        if (!$this->app->runningInConsole())
        {
            return;
        }

        $this->publishes([
            __DIR__ . '/../stubs/create_statuses_table.stub'        => Migrations::getMigrationFileName('create_statuses_table.php'),
            __DIR__ . '/../stubs/create_statuses_groups_table.stub' => Migrations::getMigrationFileName('create_statuses_groups_table.php'),
            __DIR__ . '/../stubs/fill_statuses.stub'                => Migrations::getMigrationFileName('fill_statuses.php'),
        ], 'plugin-migrations');
    }
}
