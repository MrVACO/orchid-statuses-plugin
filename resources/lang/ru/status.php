<?php

return [
    'plugin' => [
        'name'     => 'Статусы',
        'category' => 'Управление статусами',
    ],

    'permissions' => [
        "create" => "Добавлять статусы",
        "delete" => "Удалять статусы",
        "update" => "Обновлять статусы",
        "view"   => "Просматривать статусы",

        'group' => [
            "create" => "Добавлять группы",
            "delete" => "Удалять группы",
            "update" => "Обновлять группы",
            "view"   => "Просматривать группы",
        ],
    ],
    'messages'    => [
        "dont_have_permissions" => "У вас нет необходимых разрешений для просмотра этой страницы",
        "group_deleted"         => "Группа удалена",
        "group_saved"           => "Группа сохранена",
        "status_deleted"        => "Статус удален",
        "status_saved"          => "Статус сохранен",
    ],

    "active_by_default"     => "Активно (по-умолчанию)",
    "color"                 => "Цвет",
    "disabled_by_default"   => "Отключено (по-умолчанию)",
    "draft_by_default"      => "Черновик (по-умолчанию)",
    "group_add"             => "Добавить группу",
    "group_confirm_delete"  => "Группа статусов будет удалена без возможности восстановления",
    "group_edit :name"      => "Редактирование группы: :name",
    "group_edit"            => "Редактирование группы",
    "groups"                => "Группы",
    "groups_select"         => "Выберите группы",
    "preview"               => "Превью",
    "status_add"            => "Добавить статус",
    "status_confirm_delete" => "Статус будет удален без возможности восстановления",
    "status_edit :name"     => "Редактирование статуса : :name",
    "status_edit"           => "Редактирование статуса",
    "status_groups"         => "Группы статусов",
    "statuses_count"        => "Количество статусов",
];
