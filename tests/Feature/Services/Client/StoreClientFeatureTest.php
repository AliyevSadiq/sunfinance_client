<?php

namespace Tests\Feature\Services\Client;

use App\Data\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class StoreClientFeatureTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $email;


    public function setUp(): void
    {
        parent::setUp();
        $this->name = $this->faker->regexify('[A-Za-z]{2,32}');
        $this->email = $this->faker->email;
        $this->phone = $this->faker->e164PhoneNumber;
    }

    /**
     * @test
     */
    public function feature_should_pass_when_client_is_created()
    {
        $res = $this->postJson(route('clients.store'), [
            'firstName' => $this->name,
            'lastName' => $this->name,
            'email' => $this->email,
            'phoneNumber' => $this->phone,
        ]);

        $this->assertEquals($this->name, $res->json('data')['client']['firstName']);
        $this->assertEquals(Response::HTTP_CREATED, $res->getStatusCode());
    }
}
