<?php

namespace Atendwa\FilamentWorkspaceAvatars\Tests;

use Atendwa\FilamentWorkspaceAvatars\WorkspaceAvatarServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app): array
    {
        return [
            WorkspaceAvatarServiceProvider::class,
        ];
    }
}
