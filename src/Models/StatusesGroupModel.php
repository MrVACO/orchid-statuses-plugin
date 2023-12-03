<?php

namespace MrVaco\OrchidStatusesManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Screen\AsSource;

class StatusesGroupModel extends Model
{
    use AsSource;

    protected $table = 'mr_vaco__statuses_groups';

    protected $fillable = [
        'name',
        'slug'
    ];

    public array $rules = [
        'slug' => 'unique:mr_vaco__statuses_groups'
    ];

    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(StatusesGroupModel::class, 'mr_vaco__statuses_rel_groups', 'group_id', 'id');
    }
}
