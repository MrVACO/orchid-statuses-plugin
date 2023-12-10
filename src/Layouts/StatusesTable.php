<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use MrVaco\OrchidHelperCode\Screens\Tables\TDBoolean;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use MrVaco\OrchidStatusesManager\Screens\Contents\StatusContent;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatusesTable extends Table
{
    public $target = 'statuses';

    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->render(fn (StatusModel $status) => new StatusContent($status)),

            TD::make('color', __('Color'))
                ->sort()
                ->alignCenter()
                ->defaultHidden(),

            TD::make('group', __('Groups'))
                ->alignCenter()
                ->width('200px')
                ->render(function($status)
                {
                    return view(StatusClass::$plugin_prefix . '::status_groups_badge', ['groups' => $status->group]);
                }),

            TDBoolean::make('active', __('Default Active'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TDBoolean::make('disabled', __('Default Disabled'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TDBoolean::make('draft', __('Default Draft'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->alignCenter()
                ->sort(),

            TD::make(__('Actions'))
                ->alignCenter()
                ->width('100px')
                ->render(fn (StatusModel $status) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route(StatusClass::$plugin_prefix . '.status.edit', $status->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('The status will be deleted without the possibility of recovery'))
                            ->method('remove', [
                                'id' => $status->id,
                            ]),
                    ])),
        ];
    }
}
