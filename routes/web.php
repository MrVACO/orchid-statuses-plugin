<?php

declare(strict_types = 1);

use MrVaco\OrchidStatusesManager\Enums\StatusEnum;
use MrVaco\OrchidStatusesManager\Screens\StatusCreateScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusEditScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusesGroupScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusesScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusGroupCreateScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusGroupEditScreen;
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
                        ->push(__('Statuses'))
                    );

                app('router')
                    ->screen('create', StatusCreateScreen::class)
                    ->name(StatusEnum::statusCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(StatusEnum::statusView))
                        ->push(__('Create status'))
                    );

                app('router')
                    ->screen('{status}/edit', StatusEditScreen::class)
                    ->name(StatusEnum::statusUpdate)
                    ->breadcrumbs(fn (Trail $trail, $status) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(StatusEnum::statusView))
                        ->push(__('Edit status'))
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
                        ->push(__('Statuses'), route(StatusEnum::statusView))
                        ->push(__('Groups'))
                    );

                app('router')
                    ->screen('create', StatusGroupCreateScreen::class)
                    ->name(StatusEnum::groupCreate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(StatusEnum::statusView))
                        ->push(__('Groups'), route(StatusEnum::groupView))
                        ->push(__('Create status group'))
                    );

                app('router')
                    ->screen('{group}/edit', StatusGroupEditScreen::class)
                    ->name(StatusEnum::groupUpdate)
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(StatusEnum::statusView))
                        ->push(__('Groups'), route(StatusEnum::groupView))
                        ->push(__('Edit status group'))
                    );
            });
    });
