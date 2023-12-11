<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
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
            ? __('Edit status : :name', ['name' => $this->status->name])
            : __('Create status');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(sprintf('%s.status.list', StatusClass::$plugin_prefix)),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->canSee($this->status->exists && auth()->user()->hasAccess(StatusEnum::statusDelete))
                ->confirm(__('The status will be deleted without the possibility of recovery'))
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

        Toast::success(__('Status was saved'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.list');
    }

    public function remove(StatusModel $status): RedirectResponse
    {
        $status->group()->detach();
        $status->delete();

        Toast::info(__('Status was removed'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.list');
    }
}
