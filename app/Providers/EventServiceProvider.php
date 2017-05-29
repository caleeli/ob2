<?php

namespace app\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\\Events\\Captura\\CaptureSaved' => [
            'App\\Listeners\\Captura\\CaptureSavedListener',
        ],
        'App\\Events\\Captura\\CaptureCreating' => [
            'App\\Listeners\\Captura\\CaptureCreatingListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
