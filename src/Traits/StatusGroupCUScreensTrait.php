<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatuses\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatuses\Enums\StatusEnum;
use MrVaco\OrchidStatuses\Layouts\StatusGroupEditRows;
use MrVaco\OrchidStatuses\Models\StatusGroupModel;
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
            ? __(StatusEnum::author . '::status.group_edit :name', ['name' => $this->group->name])
            : __(StatusEnum::author . '::status.group_add');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(StatusEnum::groupView),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->group->exists && auth()->user()->hasAccess(StatusEnum::groupDelete))
                ->confirm(__(StatusEnum::author . '::status.group_confirm_delete'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->canSee(auth()->user()->hasAccess(StatusEnum::groupCreate))
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

        Toast::success(__(StatusEnum::author . '::status.messages.group_saved'));

        return redirect()->route(StatusEnum::groupView);
    }

    public function remove(StatusGroupModel $group): RedirectResponse
    {
        $group->statuses()->detach();
        $group->delete();

        Toast::info(__(StatusEnum::author . '::status.messages.group_deleted'));

        return redirect()->route(StatusEnum::groupView);
    }
}
