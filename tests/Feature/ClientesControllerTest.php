<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;

class RouteTest extends TestCase
{
    use DatabaseTransactions;

    public function testHomeRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function testClienteRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $response = $this->get('/cliente');

        $response->assertStatus(200);
    }

    public function testClienteEditRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $id = 1;
        $response = $this->get("/cliente/edit/{$id}");

        $response->assertStatus(200);
    }

    public function testClienteUpdateRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $id = 1;
        $data = [
            "nomeFantasia" => "Nova Empresa",
            "cnpj" => "44.557.504/0001-82",
            "endereco" => "Rua C, 789",
            "cidade" => "Cidade C",
            "estado" => "MG",
            "pais" => "Brasil",
            "telefone" => "(33) 5555-5555",
            "email" => "nova@empresa.com",
            "areaAtuacao" => "Comércio",
            "quadroSocietario" => "Sócio D"
        ];
        $response = $this->put("/cliente/edit/{$id}", $data);

        $response->assertStatus(200);
    }

    public function testClienteCreateRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $data = [
            "nomeFantasia" => "Nova Empresa",
            "cnpj" => "44.557.504/0001-82",
            "endereco" => "Rua C, 789",
            "cidade" => "Cidade C",
            "estado" => "MG",
            "pais" => "Brasil",
            "telefone" => "(33) 5555-5555",
            "email" => "nova@empresa.com",
            "areaAtuacao" => "Comércio",
            "quadroSocietario" => "Sócio D"
        ];

        $response = $this->post('/cliente/create', $data);

        $response->assertStatus(200);
    }

    public function testClienteDeleteRoute()
    {
        $user = UserFactory::new()->create();
        $this->actingAs($user);

        $id = 1;
        $response = $this->delete("/cliente/delete/{$id}");

        $response->assertStatus(200);
    }
}
