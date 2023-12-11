<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Enums;

use Orchid\Platform\ItemPermission;

enum StatusEnum: string
{
    const author = 'mr_vaco';

    const prefixPlugin = self::author . '.statuses';

    const statusView   = self::prefixPlugin . '.status.view';
    const statusCreate = self::prefixPlugin . '.status.create';
    const statusUpdate = self::prefixPlugin . '.status.update';
    const statusDelete = self::prefixPlugin . '.status.delete';

    const groupView   = self::prefixPlugin . '.status.group.view';
    const groupCreate = self::prefixPlugin . '.status.group.create';
    const groupUpdate = self::prefixPlugin . '.status.group.update';
    const groupDelete = self::prefixPlugin . '.status.group.delete';

    static public function permissions()
    {
        return ItemPermission::group(__('Statuses management'))
            ->addPermission(self::statusView, __('View statuses'))
            ->addPermission(self::statusCreate, __('Add statuses'))
            ->addPermission(self::statusUpdate, __('Update statuses'))
            ->addPermission(self::statusDelete, __('Delete statuses'))
            ->addPermission(self::groupView, __('View groups'))
            ->addPermission(self::groupCreate, __('Add groups for statuses'))
            ->addPermission(self::groupUpdate, __('Update groups'))
            ->addPermission(self::groupDelete, __('Delete groups'));
    }
}
