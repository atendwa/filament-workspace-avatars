<?php

declare(strict_types=1);

namespace Atendwa\FilamentWorkspaceAvatars\Contracts;

interface HasWorkspaceAvatar
{
    public function getFilamentAvatarUrl(): ?string;

    public function avatarColumn(): string;
}
