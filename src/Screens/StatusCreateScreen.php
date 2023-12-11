<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Traits\StatusCUScreensTrait;
use Orchid\Screen\Screen;

class StatusCreateScreen extends Screen
{
    use StatusCUScreensTrait;

    public function permission(): ?iterable
    {
        return [
            StatusEnum::statusCreate
        ];
    }
}
