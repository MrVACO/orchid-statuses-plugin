<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class StatusGroupEditRows extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make('group.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
                ->horizontal(),

            Input::make('group.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Slug'))
                ->placeholder(__('Slug'))
                ->horizontal(),
        ];
    }
}
