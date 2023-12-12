<?php

declare(strict_types = 1);

namespace MrVaco\OrchidStatusesManager\Enums;

use Orchid\Platform\ItemPermission;

enum StatusEnum: string
{
    const author = 'mr_vaco';

    const prefixPlugin = self::author . '.statuses';
    const prefixStatus = self::prefixPlugin . '.status.';
    const prefixGroup  = self::prefixPlugin . '.group.';

    const postfixView   = 'view';
    const postfixCreate = 'create';
    const postfixUpdate = 'update';
    const postfixDelete = 'delete';

    const statusView   = self::prefixStatus . self::postfixView;
    const statusCreate = self::prefixStatus . self::postfixCreate;
    const statusUpdate = self::prefixStatus . self::postfixUpdate;
    const statusDelete = self::prefixStatus . self::postfixDelete;

    const groupView   = self::prefixGroup . self::postfixView;
    const groupCreate = self::prefixGroup . self::postfixCreate;
    const groupUpdate = self::prefixGroup . self::postfixUpdate;
    const groupDelete = self::prefixGroup . self::postfixDelete;

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
