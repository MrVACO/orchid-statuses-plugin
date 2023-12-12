<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens\Contents;

use Illuminate\View\View;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Layouts\Content;

class StatusContent extends Content
{
    public function render(StatusModel $status): View
    {
        $canUpdate = auth()->user()->hasAccess(StatusEnum::statusUpdate);

        if (!$canUpdate)
        {
            return view(StatusEnum::prefixPlugin . '::status_preview', [
                'status' => $status
            ]);
        }

        return view(
            StatusEnum::prefixPlugin . '::status_table_td',
            [
                'url'    => route(StatusEnum::statusUpdate, $status->id),
                'status' => $status,
                'view'   => StatusEnum::prefixPlugin . '::status_preview'
            ]
        );
    }
}
