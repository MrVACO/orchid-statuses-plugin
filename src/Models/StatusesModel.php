<?php

namespace MrVaco\OrchidStatusesManager\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Screen\AsSource;

class StatusesModel extends Model
{
    use AsSource;

    protected $table = 'mr_vaco__statuses';

    protected $fillable = [
        'name',
        'color',
        'active',
        'disabled',
        'draft',
    ];

    public function group(): BelongsToMany
    {
        return $this->belongsToMany(StatusesGroupModel::class, 'mr_vaco__statuses_rel_groups', 'id', 'group_id');
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
