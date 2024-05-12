<?php

namespace Tests\Unit\Models;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_event(): void
    {
        // Creamos un evento utilizando el modelo Event.
        $event = Event::factory()->create([
            'name' => 'Example Event',
            'description' => 'This is an example event description.',
            'location' => 'Example Location',
            'start_date' => now(),
            'end_date' => now()->addDay(),
            // Agrega otros atributos si es necesario
        ]);

        // Verificamos que el evento haya sido creado correctamente.
        $this->assertDatabaseHas('events', [
            'name' => 'Example Event',
            'description' => 'This is an example event description.',
            'location' => 'Example Location',
            'start_date' => now(),
            'end_date' => now()->addDay(),
            // Agrega otros atributos si es necesario
        ]);
    }
}
