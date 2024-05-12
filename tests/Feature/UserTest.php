<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user(): void
    {
        // Creamos un usuario utilizando el modelo User.
        $user = User::factory()->create([
            'name' => 'John',
            'surname' => 'Doe',
            'nickname' => 'johndoe',
            'email' => 'john@example.com',
            'genre' => 'Male',
            'password' => 'password123', // Considera utilizar contraseñas más seguras en entornos de producción
            'nif' => '12345678A',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'category_id' => 1,
        ]);

        // Verificamos que el usuario haya sido creado correctamente.
        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'surname' => 'Doe',
            'nickname' => 'johndoe',
            'email' => 'john@example.com',
            'genre' => 'Male',
            'nif' => '12345678A',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'category_id' => 1,
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_delete_user(): void
    {
        // Creamos un usuario utilizando el modelo User.
        $user = User::factory()->create();

        // Eliminamos el usuario.
        $user->delete();

        // Verificamos que el usuario haya sido eliminado correctamente.
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_add_media_to_user(): void
    {
        // Creamos un usuario utilizando el modelo User.
        $user = User::factory()->create();

        // Agregamos un archivo de medios al usuario.
        $media = $user->addMedia(storage_path('example.jpg'))->toMediaCollection('profile-image');

        // Verificamos que el archivo de medios haya sido agregado correctamente.
        $this->assertInstanceOf(Media::class, $media);
        $this->assertNotNull($user->getFirstMedia('profile-image'));
    }
}
