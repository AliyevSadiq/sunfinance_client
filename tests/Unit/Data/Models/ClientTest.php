<?php

namespace Tests\Unit\Data\Models;

use App\Data\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ClientTest extends TestCase
{
    use WithFaker;


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

    /**
     * @var string
     */
    private string $phone;


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();
        $this->name = $this->faker->regexify('[A-Za-z]{2,32}');
        $this->email = $this->faker->email;
        $this->phone = $this->faker->e164PhoneNumber;
    }

    /** @test */
    public function can_get_first_name(): void
    {
        $this->client->setFirstName($this->name);

        $this->assertEquals($this->client->getFirstName(), $this->name);
    }

    /** @test */
    public function can_get_last_name(): void
    {
        $this->client->setLastName($this->name);

        $this->assertEquals($this->client->getLastName(), $this->name);
    }

    /** @test */
    public function can_get_phone(): void
    {
        $this->client->setPhoneNumber($this->phone);

        $this->assertEquals($this->client->getPhoneNumber(), $this->phone);
    }

    /** @test */
    public function can_get_email(): void
    {
        $this->client->setEmail($this->email);

        $this->assertEquals($this->client->getEmail(), $this->email);
    }
}
