<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Layouts\StatusesGroupTable;
use MrVaco\OrchidStatusesManager\Models\StatusGroupModel;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class StatusesGroupScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'groups' => StatusGroupModel::query()->filters()->defaultSort('name')->paginate()
        ];
    }

    public function name(): ?string
    {
        return __('Status groups');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->route(StatusClass::$plugin_prefix . '.status.group.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusesGroupTable::class
        ];
    }

    public function remove(Request $request): RedirectResponse
    {
        $status = StatusGroupModel::query()->findOrFail($request->get('id'));
        $status->statuses()->detach();
        $status->delete();

        Toast::info(__('Status group was removed'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.group.list');
    }
}