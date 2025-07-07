<?php

declare(strict_types=1);

namespace Atendwa\FilamentWorkspaceAvatars;

use Atendwa\Support\Concerns\Support\CanGenerateTempFiles;
use Google\Service\Directory\Resource\Users;
use Google_Client;
use Google_Service_Directory;
use Throwable;

class WorkspaceAvatar
{
    use CanGenerateTempFiles;

    public function thumbnail(string $email): ?string
    {
        try {
            $users = $this->connection()->users;

            throw_if(! $users instanceof Users, 'Invalid Google Workspace users service');

            return $users->get($email)->thumbnailPhotoUrl;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @throws Throwable
     */
    protected function connection(): Google_Service_Directory
    {
        $credentials = config('workspace-avatar.credentials');
        throw_if(! is_array($credentials), 'Invalid Google workspace credentials');

        $credentials['private_key'] = str_replace('\\n', "\n", asString($credentials['private_key']));
        $this->generateFile(json_encode($credentials, JSON_PRETTY_PRINT));

        $googleClient = new Google_Client();
        $googleClient->setScopes(['https://www.googleapis.com/auth/admin.directory.user.readonly']);
        $googleClient->setSubject(asString(config('workspace-avatar.admin_email')));
        $googleClient->setApplicationName(asString(config('app.name')));
        $googleClient->setAuthConfig($this->filePath);

        $this->cleanFile();

        return new Google_Service_Directory($googleClient);
    }
}
