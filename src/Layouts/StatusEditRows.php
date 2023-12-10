<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

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
                    ->title(__('Color')),

                Select::make('status.group')
                    ->fromQuery(StatusGroupModel::query(), 'name')
                    ->multiple()
                    ->title(__('Select groups')),
            ]),

            Group::make([
                Switcher::make('status.active')
                    ->sendTrueOrFalse()
                    ->title('Default Active'),

                Switcher::make('status.disabled')
                    ->sendTrueOrFalse()
                    ->title('Default Disabled'),

                Switcher::make('status.draft')
                    ->sendTrueOrFalse()
                    ->title('Default Draft'),
            ]),
        ];
    }
}
