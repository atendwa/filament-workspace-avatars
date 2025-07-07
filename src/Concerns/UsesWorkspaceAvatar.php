<?php

declare(strict_types=1);

namespace Atendwa\FilamentWorkspaceAvatars\Concerns;

trait UsesWorkspaceAvatar
{
    public function getFilamentAvatarUrl(): ?string
    {
        return session('google_workspace_avatar_url');
    }

    public function avatarColumn(): string
    {
        return 'avatar';
    }
}
