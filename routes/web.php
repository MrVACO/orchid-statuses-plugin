<?php

declare(strict_types = 1);

use MrVaco\OrchidStatusesManager\Screens\Statuses\EditScreen;
use MrVaco\OrchidStatusesManager\Screens\StatusesScreen;
use MrVaco\OrchidStatusesManager\StatusesServiceProvider;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->name(sprintf('%s.', StatusesServiceProvider::$plugin_prefix))
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
                    ->breadcrumbs(fn(Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses management'))
                        ->push(__('Statuses'))
                    );

                app('router')
                    ->screen('create', EditScreen::class)
                    ->name('create')
                    ->breadcrumbs(fn(Trail $trail) => $trail
                        ->parent('platform.index')
                        ->push(__('Statuses management'))
                        ->push(__('Statuses'), route(sprintf('%s.status.list', StatusesServiceProvider::$plugin_prefix)))
                        ->push(__('Create status'))
                    );

                app('router')
                    ->screen('create/save', EditScreen::class)
                    ->name('create.save');
            });
    });
