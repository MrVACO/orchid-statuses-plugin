<?php

declare(strict_types = 1);

use MrVaco\OrchidStatusesManager\Screens\StatusesScreen;
use MrVaco\OrchidStatusesManager\StatusesServiceProvider;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->name(StatusesServiceProvider::$plugin_prefix . '.')
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
    });
