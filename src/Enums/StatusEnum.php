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
        return ItemPermission::group(__(StatusEnum::author . '::status.plugin.category'))
            ->addPermission(self::statusView, __(StatusEnum::author . '::status.permissions.view'))
            ->addPermission(self::statusCreate, __(StatusEnum::author . '::status.permissions.create'))
            ->addPermission(self::statusUpdate, __(StatusEnum::author . '::status.permissions.update'))
            ->addPermission(self::statusDelete, __(StatusEnum::author . '::status.permissions.delete'))
            ->addPermission(self::groupView, __(StatusEnum::author . '::status.permissions.group.view'))
            ->addPermission(self::groupCreate, __(StatusEnum::author . '::status.permissions.group.create'))
            ->addPermission(self::groupUpdate, __(StatusEnum::author . '::status.permissions.group.update'))
            ->addPermission(self::groupDelete, __(StatusEnum::author . '::status.permissions.group.delete'));
    }
}
