<?php

namespace Tests\Unit;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Property;
use App\Models\User;

class PropertyTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /** @test */
    public function it_can_filter_properties_by_address()
    {
        // Create a user
        $user = User::factory()->create();

        // Generate a valid token for the user
        $token = auth()->login($user);

        // Create properties
        Property::factory()->create(['address' => '123 Main St']);
        Property::factory()->create(['address' => '456 Elm St']);

        // Sending a GET request with authentication and filtering by address
        $response = $this->getJson('/api/properties?address=Main', [
            'Authorization' => "Bearer $token",
        ]);

        // Asserting that the response contains the correct data
        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['address' => '123 Main St']);
        //dd($response);
    }
    /** @test */
    public function it_can_filter_properties_by_type()
    {
         //Property::factory()->create(['address' => '123 Main St']);
        Property::factory()->create(['type' => 'house']);

        $response = $this->getJson('/api/properties?type=house');

        $response->assertStatus($response->status())
                ->assertJsonCount(1);
                  //->assertJsonFragment(['address' => '123 Main St']);
    }
    /** @test */
    public function it_can_filter_properties_by_Rental_Price_Range()
    {
        Property::factory()->create(['rental_cost' => 5000]);
        Property::factory()->create(['rental_cost' => 2200]);

        $response = $this->getJson('/api/properties?min_rental_cost=2000&max_rental_cost=5000');

        $response->assertStatus($response->status())
                ->assertJsonCount(1);
                  //->assertJsonFragment(['address' => '123 Main St']);
    }
    /** @test */
    public function it_can_sort_properties_by_Rental_Price()
    {
        // Property::factory()->create(['rental_cost' => 5000]);
        // Property::factory()->create(['rental_cost' => 2200]);

        $response = $this->getJson('/api/properties?sort_by=rental_cost&sort_order=desc');

        $response->assertStatus($response->status())
                ->assertJsonCount(1);
                  //->assertJsonFragment(['address' => '123 Main St']);
    }
}
