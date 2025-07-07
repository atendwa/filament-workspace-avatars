<?php

declare(strict_types=1);

namespace Atendwa\FilamentWorkspaceAvatars;

use Atendwa\FilamentWorkspaceAvatars\Listeners\LoginListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class WorkspaceAvatarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/workspace-avatar.php', 'workspace-avatar');
    }

    public function boot(): void
    {
        Event::subscribe(LoginListener::class);
    }
}
