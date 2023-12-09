<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use MrVaco\OrchidHelperCode\Screens\Tables\TDBoolean;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use MrVaco\OrchidStatusesManager\Screens\Contents\StatusContent;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatusesLayout extends Table
{
    public $target = 'statuses';

    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->cantHide()
                ->render(fn (StatusModel $status) => new StatusContent($status)),

            TD::make('color', __('Color'))
                ->sort()
                ->alignCenter()
                ->defaultHidden(),

            TD::make('group', __('Groups'))
                ->alignCenter()
                ->render(function($status)
                {
                    return view('mr_vaco.statuses::status_groups_badge', ['groups' => $status->group]);
                }),

            TDBoolean::make('active', __('Default Active'))
                ->alignCenter(),

            TDBoolean::make('disabled', __('Default Disabled'))
                ->alignCenter(),

            TDBoolean::make('draft', __('Default Draft'))
                ->alignCenter(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),
        ];
    }
}
