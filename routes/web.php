<?php

declare(strict_types = 1);

use MrVaco\OrchidStatusesManager\Classes\StatusClass;
use MrVaco\OrchidStatusesManager\Screens\Statuses\EditScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusesScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->name(sprintf('%s.', StatusClass::$plugin_prefix))
    ->group(static function()
    {
        app('router')
            ->name('status.')
            ->prefix('statuses')
            ->group(static function()
            {
                app('router')
                    ->screen('', StatusesScreen::class)
                    ->name('list')
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'))
                    );

                app('router')
                    ->screen('create', EditScreen::class)
                    ->name('create')
                    ->breadcrumbs(fn (Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(sprintf('%s.status.list', StatusClass::$plugin_prefix)))
                        ->push(__('Create status'))
                    );

                app('router')
                    ->screen('create/save', EditScreen::class)
                    ->name('create.save');

                app('router')
                    ->screen('{status}/edit', EditScreen::class)
                    ->name('edit')
                    ->breadcrumbs(fn (Trail $trail, $status) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses'), route(sprintf('%s.status.list', StatusClass::$plugin_prefix)))
                        ->push(__('Edit status'), route(sprintf('%s.status.edit', StatusClass::$plugin_prefix), $status))
                    );

                app('router')
                    ->screen('{status}/edit/remove', EditScreen::class)
                    ->name('remove');
            });
    });
