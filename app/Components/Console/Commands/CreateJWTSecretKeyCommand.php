<?php
/**
 * Command for create JWT secret key.
 */

namespace Simpler\Components\Console\Commands;

use Simpler\Components\Console\Command;
use Exception;
use Simpler\Components\Facades\File;
use Simpler\Utils\StringUtil;

class CreateJWTSecretKeyCommand extends Command
{
    /**
     * @return int
     */
    public function handle(): int
    {
        try {
            if (File::has(storagePath('jwt-secret.txt'))) {
                $this->warning('The secret string has already been generated');
            }

            $secret = StringUtil::randSecure(128);
            File::put(storagePath('jwt-secret.key'), $secret);

            $this->info('Secret key: '.$secret);
            $this->success('Secret key generated -> '.storagePath('jwt-secret.key'));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        return 0;
    }
}
