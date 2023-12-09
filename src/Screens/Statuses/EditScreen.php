<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens\Statuses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Layouts\StatusEditLayer;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use MrVaco\OrchidStatusesManager\StatusesServiceProvider;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class EditScreen extends Screen
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
            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->status->exists),

            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->route(sprintf('%s.status.list', StatusesServiceProvider::$plugin_prefix)),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusEditLayer::class,
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

        return redirect()->route(StatusesServiceProvider::$plugin_prefix . '.status.list');
    }

    public function remove(StatusModel $status): RedirectResponse
    {
        $status->group()->detach();
        $status->delete();

        Toast::info(__('Status was removed'));

        return redirect()->route(StatusesServiceProvider::$plugin_prefix . '.status.list');
    }
}
