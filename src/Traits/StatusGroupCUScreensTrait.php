<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Layouts\StatusGroupEditRows;
use MrVaco\OrchidStatusesManager\Models\StatusGroupModel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

trait StatusGroupCUScreensTrait
{
    public $group;

    public function query(StatusGroupModel $group): iterable
    {
        return [
            'group' => $group,
        ];
    }

    public function name(): ?string
    {
        return $this->group->exists
            ? __('Edit status group : :name', ['name' => $this->group->name])
            : __('Create status group');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(sprintf('%s.status.group.list', StatusClass::$plugin_prefix)),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->group->exists && auth()->user()->hasAccess(StatusEnum::groupDelete))
                ->confirm(__('The status group will be deleted without the possibility of recovery'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusGroupEditRows::class,
        ];
    }

    public function save(StatusGroupModel $group, Request $request): RedirectResponse
    {
        $request->validate([
            'group.name' => [
                'required'
            ],
            'group.slug' => [
                'required'
            ],
        ]);

        $group
            ->fill($request->collect('group')->toArray())
            ->save();

        Toast::success(__('Status group was saved'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.group.list');
    }

    public function remove(StatusGroupModel $group): RedirectResponse
    {
        $group->statuses()->detach();
        $group->delete();

        Toast::info(__('Status group was removed'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.group.list');
    }
}
