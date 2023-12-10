<?php

namespace MrVaco\OrchidStatusesManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class StatusGroupModel extends Model
{
    use AsSource, Filterable;

    protected $table = 'mr_vaco__statuses_groups';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected array $allowedSorts = [
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    public array $rules = [
        'slug' => 'unique:mr_vaco__statuses_groups'
    ];

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(StatusModel::class, 'mr_vaco__statuses_rel_groups', 'group_id', 'id');
    }
}
