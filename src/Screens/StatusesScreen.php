<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use MrVaco\OrchidStatusesManager\Layouts\StatusesLayout;
use MrVaco\OrchidStatusesManager\Models\StatusesModel;
use Orchid\Screen\Screen;

class StatusesScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'statuses' => StatusesModel::query()->get()
        ];
    }

    public function name(): ?string
    {
        return __('Statuses');
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            StatusesLayout::class,
        ];
    }
}
