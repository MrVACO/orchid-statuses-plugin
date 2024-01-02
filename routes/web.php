<?php

declare(strict_types = 1);

use MrVaco\OrchidStatuses\Enums\StatusEnum;
use MrVaco\OrchidStatuses\Screens\StatusCreateScreen;
use MrVaco\OrchidStatuses\Screens\StatusEditScreen;
use MrVaco\OrchidStatuses\Screens\StatusesGroupScreen;
use MrVaco\OrchidStatuses\Screens\StatusesScreen;
use MrVaco\OrchidStatuses\Screens\StatusGroupCreateScreen;
use MrVaco\OrchidStatuses\Screens\StatusGroupEditScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->prefix('statuses')
    ->group(static function()
    {
        app('router')
            ->name('')
            ->group(static function()
            {
                app('router')
                    ->screen('', StatusesScreen::class)
                    ->name(StatusEnum::statusView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'))
                    );

                app('router')
                    ->screen('create', StatusCreateScreen::class)
                    ->name(StatusEnum::statusCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'), route(StatusEnum::statusView))
                        ->push(__(StatusEnum::author . '::status.status_add'))
                    );

                app('router')
                    ->screen('{status}/edit', StatusEditScreen::class)
                    ->name(StatusEnum::statusUpdate)
                    ->breadcrumbs(fn (Trail $trail, $status) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'), route(StatusEnum::statusView))
                        ->push(__(StatusEnum::author . '::status.status_edit'))
                    );
            });

        app('router')
            ->name('')
            ->prefix('group')
            ->group(static function()
            {
                app('router')
                    ->screen('', StatusesGroupScreen::class)
                    ->name(StatusEnum::groupView)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'), route(StatusEnum::statusView))
                        ->push(__(StatusEnum::author . '::status.groups'))
                    );

                app('router')
                    ->screen('create', StatusGroupCreateScreen::class)
                    ->name(StatusEnum::groupCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'), route(StatusEnum::statusView))
                        ->push(__(StatusEnum::author . '::status.groups'), route(StatusEnum::groupView))
                        ->push(__(StatusEnum::author . '::status.group_add'))
                    );

                app('router')
                    ->screen('{group}/edit', StatusGroupEditScreen::class)
                    ->name(StatusEnum::groupUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__(StatusEnum::author . '::status.plugin.name'), route(StatusEnum::statusView))
                        ->push(__(StatusEnum::author . '::status.groups'), route(StatusEnum::groupView))
                        ->push(__(StatusEnum::author . '::status.group_edit'))
                    );
            });
    });
