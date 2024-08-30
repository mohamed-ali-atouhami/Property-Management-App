<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_authentication_for_protected_routes()
    {
        $response = $this->getJson('/api/properties');

        $response->assertStatus(401);
    }

    /** @test */
    public function it_allows_access_to_protected_routes_with_valid_token()
    {
        $user = User::factory()->create();

        $token = auth()->login($user);

        $response = $this->getJson('/api/properties', ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200);
    }
}
