<?php

namespace App\Providers;

use App\Enums\GuardEnum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes([
            'prefix' => GuardEnum::STUDENT,
            'middleware' => [
                'api', 'auth:student', 'scope:student',
            ],
        ]);

        Broadcast::routes([
            'prefix' => GuardEnum::TEACHER,
            'middleware' => [
                'api', 'auth:teacher', 'scope:teacher',
            ]
        ]);

        require base_path('routes/channels.php');
    }
}
