<?php

namespace MrVaco\OrchidStatuses\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class StatusModel extends Model
{
    use AsSource, Filterable;

    protected $table = 'mr_vaco__statuses';

    protected $fillable = [
        'name',
        'color',
        'active',
        'disabled',
        'draft',
    ];

    protected array $allowedSorts = [
        'name',
        'color',
        'active',
        'disabled',
        'draft',
        'created_at',
        'updated_at'
    ];

    public function group(): BelongsToMany
    {
        return $this->belongsToMany(StatusGroupModel::class, 'mr_vaco__statuses_rel_groups', 'id', 'group_id');
    }

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeIsDisabled(Builder $query): Builder
    {
        return $query->where('disabled', true);
    }

    public function scopeIsDraft(Builder $query): Builder
    {
        return $query->where('draft', true);
    }
}
