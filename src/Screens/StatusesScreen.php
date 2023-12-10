<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Screens;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Layouts\StatusesTable;
use MrVaco\OrchidStatusesManager\Models\StatusModel;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class StatusesScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'statuses' => StatusModel::query()->filters()->defaultSort('id')->paginate()
        ];
    }

    public function name(): ?string
    {
        return __('Statuses');
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->route(StatusClass::$plugin_prefix . '.status.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            StatusesTable::class,
        ];
    }

    public function remove(Request $request): RedirectResponse
    {
        $status = StatusModel::query()->findOrFail($request->get('id'));
        $status->group()->detach();
        $status->delete();

        Toast::info(__('Status was removed'));

        return redirect()->route(StatusClass::$plugin_prefix . '.status.list');
    }
}
