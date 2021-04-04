<?php

namespace Tests\Feature;

use App\Models\Usuarios;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUsuariosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_usuarios_list_in_usuarios_index_page()
    {
        $usuarios = Usuarios::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('usuarios.index');
        $this->see($usuarios->title);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Usuarios 1 title',
            'description' => 'Usuarios 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_usuarios()
    {
        $this->loginAsUser();
        $this->visitRoute('usuarios.index');

        $this->click(__('usuarios.create'));
        $this->seeRouteIs('usuarios.create');

        $this->submitForm(__('usuarios.create'), $this->getCreateFields());

        $this->seeRouteIs('usuarios.show', Usuarios::first());

        $this->seeInDatabase('usuarios', $this->getCreateFields());
    }

    /** @test */
    public function validate_usuarios_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('usuarios.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_usuarios_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('usuarios.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_usuarios_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('usuarios.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Usuarios 1 title',
            'description' => 'Usuarios 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_usuarios()
    {
        $this->loginAsUser();
        $usuarios = Usuarios::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('usuarios.show', $usuarios);
        $this->click('edit-usuarios-'.$usuarios->id);
        $this->seeRouteIs('usuarios.edit', $usuarios);

        $this->submitForm(__('usuarios.update'), $this->getEditFields());

        $this->seeRouteIs('usuarios.show', $usuarios);

        $this->seeInDatabase('usuarios', $this->getEditFields([
            'id' => $usuarios->id,
        ]));
    }

    /** @test */
    public function validate_usuarios_title_update_is_required()
    {
        $this->loginAsUser();
        $usuarios = Usuarios::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('usuarios.update', $usuarios), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_usuarios_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $usuarios = Usuarios::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('usuarios.update', $usuarios), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_usuarios_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $usuarios = Usuarios::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('usuarios.update', $usuarios), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_usuarios()
    {
        $this->loginAsUser();
        $usuarios = Usuarios::factory()->create();
        Usuarios::factory()->create();

        $this->visitRoute('usuarios.edit', $usuarios);
        $this->click('del-usuarios-'.$usuarios->id);
        $this->seeRouteIs('usuarios.edit', [$usuarios, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('usuarios', [
            'id' => $usuarios->id,
        ]);
    }
}
