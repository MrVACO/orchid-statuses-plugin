<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Traits\StatusGroupCUScreensTrait;
use Orchid\Screen\Screen;

class StatusGroupCreateScreen extends Screen
{
    use StatusGroupCUScreensTrait;

    public function permission(): ?iterable
    {
        return [StatusEnum::groupCreate];
    }
}
