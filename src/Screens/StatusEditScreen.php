<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Layouts\StatusEditRows;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class StatusEditScreen extends Screen
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
                ->method('remove')
                ->confirm(__('The status will be deleted without the possibility of recovery'))
                ->canSee($this->status->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
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
