<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UsuariosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_usuarios_has_title_link_attribute()
    {
        $usuarios = Usuarios::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $usuarios->title, 'type' => __('usuarios.usuarios'),
        ]);
        $link = '<a href="'.route('usuarios.show', $usuarios).'"';
        $link .= ' title="'.$title.'">';
        $link .= $usuarios->title;
        $link .= '</a>';

        $this->assertEquals($link, $usuarios->title_link);
    }

    /** @test */
    public function a_usuarios_has_belongs_to_creator_relation()
    {
        $usuarios = Usuarios::factory()->make();

        $this->assertInstanceOf(User::class, $usuarios->creator);
        $this->assertEquals($usuarios->creator_id, $usuarios->creator->id);
    }
}
