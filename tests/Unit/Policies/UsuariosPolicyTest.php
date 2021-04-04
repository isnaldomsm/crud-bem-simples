<?php

namespace Tests\Unit\Policies;

use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UsuariosPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_usuarios()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Usuarios));
    }

    /** @test */
    public function user_can_view_usuarios()
    {
        $user = $this->createUser();
        $usuarios = Usuarios::factory()->create();
        $this->assertTrue($user->can('view', $usuarios));
    }

    /** @test */
    public function user_can_update_usuarios()
    {
        $user = $this->createUser();
        $usuarios = Usuarios::factory()->create();
        $this->assertTrue($user->can('update', $usuarios));
    }

    /** @test */
    public function user_can_delete_usuarios()
    {
        $user = $this->createUser();
        $usuarios = Usuarios::factory()->create();
        $this->assertTrue($user->can('delete', $usuarios));
    }
}
