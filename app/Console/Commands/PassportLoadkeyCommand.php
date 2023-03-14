<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Passport\Passport;

class PassportLoadkeyCommand extends Command
{
    protected $signature = 'passport:loadkey';

    protected $description = 'Command description';

    public function handle()
    {
        list($publicKey, $privateKey) = [
            Passport::keyPath('oauth-public.key'),
            Passport::keyPath('oauth-private.key'),
        ];

        if (!file_exists($publicKey)) {
            file_put_contents($publicKey, config('auth.passport.public_key'));
        }

        if (!file_exists($privateKey)) {
            file_put_contents($privateKey, config('auth.passport.private_key'));
        }
    }
}
