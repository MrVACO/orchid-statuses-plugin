<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use MrVaco\OrchidHelperCode\Screens\Tables\TDBoolean;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
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

            TD::make('color', __(StatusEnum::author . '::status.color'))
                ->sort()
                ->alignCenter()
                ->defaultHidden(),

            TD::make('group', __(StatusEnum::author . '::status.groups'))
                ->alignCenter()
                ->width('200px')
                ->render(function($status)
                {
                    return view(StatusEnum::prefixPlugin . '::status_groups_badge', ['groups' => $status->group]);
                }),

            TDBoolean::make('active', __(StatusEnum::author . '::status.active_by_default'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TDBoolean::make('disabled', __(StatusEnum::author . '::status.disabled_by_default'))
                ->sort()
                ->width('150px')
                ->alignCenter(),

            TDBoolean::make('draft', __(StatusEnum::author . '::status.draft_by_default'))
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
                ->canSee(auth()->user()->hasAnyAccess([StatusEnum::statusUpdate, StatusEnum::statusDelete]))
                ->render(fn (StatusModel $status) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->icon('bs.pencil')
                            ->canSee(auth()->user()->hasAccess(StatusEnum::statusUpdate))
                            ->route(StatusEnum::statusUpdate, $status->id),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->canSee(auth()->user()->hasAccess(StatusEnum::statusDelete))
                            ->confirm(__(StatusEnum::author . '::status.status_confirm_delete'))
                            ->method('remove', ['id' => $status->id]),
                    ])),
        ];
    }
}
