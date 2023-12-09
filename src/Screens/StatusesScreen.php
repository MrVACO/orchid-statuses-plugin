<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Layouts\StatusesLayout;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class StatusesScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'statuses' => StatusModel::query()->get()
        ];
    }

    public function name(): ?string
    {
        return __('Statuses');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->route(StatusClass::$plugin_prefix . '.status.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusesLayout::class,
        ];
    }
}
