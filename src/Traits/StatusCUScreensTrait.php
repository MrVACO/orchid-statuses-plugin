<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Layouts\StatusEditRows;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

trait StatusCUScreensTrait
{
    public $status;

    public function query(StatusModel $status): iterable
    {
        return [
            'status' => $status,
        ];
    }

    public function name(): ?string
    {
        return $this->status->exists
            ? __(StatusEnum::author . '::status.status_edit :name', ['name' => $this->status->name])
            : __(StatusEnum::author . '::status.status_add');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(StatusEnum::statusView),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->status->exists && auth()->user()->hasAccess(StatusEnum::statusDelete))
                ->confirm(__(StatusEnum::author . '::status.status_confirm_delete'))
                ->method('remove'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->canSee(auth()->user()->hasAccess(StatusEnum::statusCreate))
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusEditRows::class,
        ];
    }

    public function save(StatusModel $status, Request $request): RedirectResponse
    {
        $request->validate([
            'status.name' => [
                'required',
            ],
        ]);

        $status
            ->fill($request->collect('status')->toArray())
            ->save();

        $groups = $request->input('status.group');
        $status->group()->detach();
        $status->group()->attach($groups);

        Toast::success(__(StatusEnum::author . '::status.messages.status_saved'));

        return redirect()->route(StatusEnum::statusView);
    }

    public function remove(StatusModel $status): RedirectResponse
    {
        $status->group()->detach();
        $status->delete();

        Toast::info(__(StatusEnum::author . '::status.messages.status_deleted'));

        return redirect()->route(StatusEnum::statusView);
    }
}
