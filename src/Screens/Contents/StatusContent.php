<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens\Contents;

use Illuminate\View\View;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Layouts\Content;

class StatusContent extends Content
{
    public function render(StatusModel $status): View
    {
        $prefix = StatusClass::$plugin_prefix;

        return view(
            $prefix . '::status_table_td',
            [
                'name'   => $status->name,
                'url'    => route(sprintf('%s.status.edit', $prefix), $status->id),
                'status' => $status,
                'view'   => $prefix . '::status_preview'
            ]
        );
    }
}
