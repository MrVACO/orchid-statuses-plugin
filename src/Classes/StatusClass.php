<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Classes;

use MrVaco\OrchidStatusesManager\Models\StatusModel;

class StatusClass
{
    static public function DEFAULT_ID(): int
    {
        return StatusModel::query()->first()->id;
    }

    static public function ACTIVE(): StatusModel
    {
        return StatusModel::isActive()->first();
    }

    static public function DISABLED(): StatusModel
    {
        return StatusModel::isDisabled()->first();
    }

    static public function DRAFT(): StatusModel
    {
        return StatusModel::isDraft()->first();
    }

    static public function BY_ID(int $id): StatusModel
    {
        return StatusModel::query()->findOrFail($id);
    }

    static public function LIST(string $slug, bool $swap = false): array
    {
        $data = StatusModel::query()
            ->whereHas('group', function($query) use ($slug)
            {
                $query->where('slug', 'like', $slug . '%');
            })
            ->get();

        if ($swap)
            return $data->pluck('id', 'name')->toArray();

        return $data->pluck('name', 'key')->toArray();
    }
}
