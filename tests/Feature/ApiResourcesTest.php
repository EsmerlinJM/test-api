<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiResourcesTest extends TestCase
{
    /**
     * Test get contact informations url.
     *
     * @return void
     */
    public function test_get_contact_informations()
    {
        $this->json('get', '/api/v1/contacts')->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                        'total',
                        'rows'  => [
                            'data' => [
                                ['id',
                                'first_name',
                                'last_name',
                                'phones',
                                'addresses',]
                            ]
                        ]
                        
            ]
        );
    }

    /**
     * Test get contact informations url.
     *
     * @return void
     */
    public function test_store_contact_informations()
    {

        $payload = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phones' => [$this->faker->unique()->numerify('809-###-####'),$this->faker->unique()->numerify('809-###-####')],
            'addresses' => [$this->faker->address(), $this->faker->address()]
        ];

        $this->json('post', '/api/v1/contacts/register', $payload)->assertStatus(Response::HTTP_CREATED);
        
    }
}
