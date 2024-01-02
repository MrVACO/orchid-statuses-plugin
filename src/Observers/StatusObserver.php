<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatuses\Observers;

use Illuminate\Database\Eloquent\Builder;
use MrVaco\OrchidStatuses\Models\StatusModel;

class StatusObserver
{
    public function saved(StatusModel $model): void
    {
        $this->refreshStatuses($model);
    }

    protected function refreshStatuses(StatusModel $model): void
    {
        $this->disableStatuses($model, [
            'active'   => $model->active,
            'disabled' => $model->disabled,
            'draft'    => $model->draft,
        ]);
    }

    protected function disableStatuses(StatusModel $model, array $statuses): void
    {
        $columns = collect($statuses)->filter();

        StatusModel::query()
            ->whereNot('id', $model->id)
            ->where(
                fn (Builder $query) => $query->where($columns->all(), boolean: 'or')
            )
            ->update(
                $columns->map(fn (bool $value) => false)->all()
            );
    }
}
