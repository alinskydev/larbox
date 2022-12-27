<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\User\Models\AccessToken;

class DeleteExpiredUserAccessTokensCommand extends Command
{
    protected $signature = 'larbox:delete_expired_user_access_tokens_command';

    protected $description = 'Delete expired user access tokens';

    public function handle(): void
    {
        AccessToken::query()->where('expires_at', '<', date('Y-m-d H:i:s'))->delete();

        $this->line('Successfully done');
    }
}
