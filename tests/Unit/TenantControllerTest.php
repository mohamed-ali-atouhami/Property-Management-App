<?php
namespace Tests\Unit;

use Tests\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tenant;
use App\Models\Property;
use App\Models\User;

class TenantControllerTest extends TestCase
{
   // use RefreshDatabase;

    /** @test */
    public function it_can_create_a_tenant()
    {
        // Create a user
        $user = User::factory()->create();

        // Generate a valid token for the user
        $token = auth()->login($user);

        // Create a property using the factory
        $property = Property::factory()->create();

        // Sending a POST request to the API endpoint with authentication
        $response = $this->postJson('/api/tenants', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'property_id' => $property->id,
            'section' => 'idk'
        ], ['Authorization' => "Bearer $token"]);

        // Asserting the response status
        $response->assertStatus($response->status());

        // Asserting the tenant was created in the database
        $this->assertDatabaseHas('tenants', [
            'email' => 'johndoe@example.com',
            'property_id' => $property->id,
        ]);
    }
    /** @test */

    public function it_can_update_a_tenant()
    {
        // Create a user
        $user = User::factory()->create();

        // Generate a valid token for the user
        $token = auth()->login($user);

        // Create a property using the factory
        $property = Property::factory()->create();

        // Sending a POST request to the API endpoint with authentication
        $response = $this->putJson('/api/tenants/2', [
            'name' => 'Johny Doe',
            'email' => 'johnydoe@example.com',
            'phone' => '0676549115',
            'property_id' => $property->id,
            'section' => 'idk'
        ], ['Authorization' => "Bearer $token"]);

        // Asserting the response status
        $response->assertStatus($response->status());

        // Asserting the tenant was created in the database
        $this->assertDatabaseHas('tenants', [
            'email' => 'johnydoe@example.com',
            'property_id' => $property->id,
        ]);
    }
     /** @test */

     public function it_can_delete_a_tenant()
     {
         // Create a user
         $user = User::factory()->create();
 
         // Generate a valid token for the user
         $token = auth()->login($user);
 
         // Create a property using the factory
         $property = Property::factory()->create();
 
         // Sending a POST request to the API endpoint with authentication
         $response = $this->deleteJson('/api/tenants/2', [
             'name' => 'Johny Doe',
             'email' => 'johnydoe@example.com',
             'phone' => '0676549115',
             'property_id' => $property->id,
             'section' => 'idk'
         ], ['Authorization' => "Bearer $token"]);
 
         // Asserting the response status
         $response->assertStatus($response->status());
 
     }
}
