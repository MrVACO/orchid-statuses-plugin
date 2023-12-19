<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Models\StatusGroupModel;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class StatusEditRows extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make('status.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
                ->horizontal(),

            Group::make([
                Input::make('status.color')
                    ->type('color')
                    ->value('#' . substr(md5((string) rand()), 0, 6))
                    ->title(__(StatusEnum::author . '::status.color')),

                Select::make('status.group')
                    ->fromQuery(StatusGroupModel::query(), 'name')
                    ->multiple()
                    ->title(__(StatusEnum::author . '::status.groups_select')),
            ]),

            Group::make([
                Switcher::make('status.active')
                    ->sendTrueOrFalse()
                    ->title(StatusEnum::author . '::status.active_by_default'),

                Switcher::make('status.disabled')
                    ->sendTrueOrFalse()
                    ->title(StatusEnum::author . '::status.disabled_by_default'),

                Switcher::make('status.draft')
                    ->sendTrueOrFalse()
                    ->title(StatusEnum::author . '::status.draft_by_default'),
            ]),
        ];
    }
}
