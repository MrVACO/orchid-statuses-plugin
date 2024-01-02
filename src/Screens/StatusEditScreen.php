<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatuses\Screens;

use MrVaco\OrchidStatuses\Enums\StatusEnum;
use MrVaco\OrchidStatuses\Traits\StatusCUScreensTrait;
use Orchid\Screen\Screen;

class StatusEditScreen extends Screen
{
    use StatusCUScreensTrait;

    public function permission(): ?iterable
    {
        return [
            StatusEnum::statusUpdate
        ];
    }
}
