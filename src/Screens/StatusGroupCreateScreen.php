<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatuses\Screens;

use MrVaco\OrchidStatuses\Enums\StatusEnum;
use MrVaco\OrchidStatuses\Traits\StatusGroupCUScreensTrait;
use Orchid\Screen\Screen;

class StatusGroupCreateScreen extends Screen
{
    use StatusGroupCUScreensTrait;

    public function permission(): ?iterable
    {
        return [StatusEnum::groupCreate];
    }
}
