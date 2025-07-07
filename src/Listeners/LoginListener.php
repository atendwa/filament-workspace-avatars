<?php

declare(strict_types=1);

namespace Atendwa\FilamentWorkspaceAvatars\Listeners;

use Atendwa\FilamentWorkspaceAvatars\WorkspaceAvatar;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Throwable;

class LoginListener
{
    /**
     * @throws Throwable
     */
    public function handleUserLogin(Login $login): void
    {
        if (session()->has('google_workspace_avatar_url')) {
            return;
        }

        $email = asInstanceOf($login->user, Model::class)->getAttribute('email');

        session()->put('google_workspace_avatar_url', app(WorkspaceAvatar::class)->thumbnail($email));
    }

    /**
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $dispatcher): array
    {
        return match (filled($dispatcher)) {
            true => [Login::class => 'handleUserLogin'],
            false => [],
        };
    }
}
