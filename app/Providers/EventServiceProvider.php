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
        'App\\Events\\UserAdministration\\AvanceCreated' => [
            'App\\Listeners\\UserAdministration\\AvanceCreatedListener',
        ],
        'App\\Events\\UserAdministration\\AvanceCreating' => [
            'App\\Listeners\\UserAdministration\\AvanceCreatingListener',
        ],
        'App\\Events\\UserAdministration\\AvanceSaved' => [
            'App\\Listeners\\UserAdministration\\AvanceSavedListener',
        ],
        'App\\Events\\UserAdministration\\TareaCreating' => [
            'App\\Listeners\\UserAdministration\\TareaCreatingListener',
        ],
        'App\\Events\\UserAdministration\\TareaSaved' => [
            'App\\Listeners\\UserAdministration\\TareaSavedListener',
        ],
        'App\\Events\\UserAdministration\\EstadoFinancieroSave' => [
            'App\\Listeners\\UserAdministration\\EstadoFinancieroSaveListener',
        ],
        'App\\Events\\UserAdministration\\EstadoFinancieroSaving' => [
            'App\\Listeners\\UserAdministration\\EstadoFinancieroSavingListener',
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
