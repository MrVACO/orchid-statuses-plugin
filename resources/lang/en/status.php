<?php

return [
    'plugin' => [
        'name'     => 'Statuses',
        'category' => 'Status management',
    ],

    'permissions' => [
        "create" => "Add statuses",
        "delete" => "Delete statuses",
        "update" => "Update statuses",
        "view"   => "View statuses",

        'group' => [
            "create" => "Add groups",
            "delete" => "Delete groups",
            "update" => "Update groups",
            "view"   => "View groups",
        ],
    ],
    'messages'    => [
        "dont_have_permissions" => "You do not have the necessary permissions to view this page",
        "group_deleted"         => "Group deleted",
        "group_saved"           => "Group saved",
        "status_deleted"        => "Status deleted",
        "status_saved"          => "Status saved",
    ],

    "active_by_default"     => "Active (default)",
    "color"                 => "Color",
    "disabled_by_default"   => "Disabled (default)",
    "draft_by_default"      => "Draft (default)",
    "group_add"             => "Add a group",
    "group_confirm_delete"  => "The status group will be deleted without the possibility of recovery",
    "group_edit :name"      => "Editing a group: :name",
    "group_edit"            => "Editing a group",
    "groups"                => "Groups",
    "groups_select"         => "Select groups",
    "preview"               => "Preview",
    "status_add"            => "Add status",
    "status_confirm_delete" => "The status will be deleted without the possibility of recovery",
    "status_edit :name"     => "Editing status : :name",
    "status_edit"           => "Editing status",
    "status_groups"         => "Status groups",
    "statuses_count"        => "Statuses count",
];
