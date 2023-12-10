<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Models\StatusGroupModel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StatusesGroupTable extends Table
{
    public $target = 'groups';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->render(fn (StatusGroupModel $group) => Link::make($group->name)->route(StatusClass::$plugin_prefix . '.status.group.edit', $group->id)),

            TD::make('slug', __('Slug'))
                ->sort()
                ->alignCenter(),

            TD::make('statuses_count', __('Count'))
                ->sort()
                ->alignCenter()
                ->render(fn (StatusGroupModel $group) => $group->statuses->count()),

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
                ->render(fn (StatusGroupModel $group) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route(StatusClass::$plugin_prefix . '.status.edit', $group->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('The status group will be deleted without the possibility of recovery'))
                            ->method('remove', [
                                'id' => $group->id,
                            ]),
                    ])),
        ];
    }
}
