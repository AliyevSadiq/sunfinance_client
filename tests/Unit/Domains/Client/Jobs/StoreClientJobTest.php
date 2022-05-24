<?php

namespace Tests\Unit\Domains\Client\Jobs;

use App\Data\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domains\Client\Jobs\StoreClientJob;

class StoreClientJobTest extends TestCase
{
    use WithFaker,RefreshDatabase;

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

    public function setUp(): void
    {
        parent::setUp();

        $this->name = $this->faker->regexify('[A-Za-z]{2,32}');
        $this->email = $this->faker->email;
        $this->phone = $this->faker->e164PhoneNumber;

        $job=new StoreClientJob($this->name,$this->name,$this->phone,$this->email);

        $this->client=$job->handle();
    }

    /**
     * @test
     */
    public function job_should_pass_when_firstname_exists()
    {
        $this->assertEquals($this->client->getFirstName(),$this->name);
    }

    /**
     * @test
     */
    public function job_should_pass_when_lastname_exists()
    {
        $this->assertEquals($this->client->getLastName(),$this->name);
    }

    /**
     * @test
     */
    public function job_should_pass_when_email_exists()
    {
        $this->assertEquals($this->client->getEmail(),$this->email);
    }

    /**
     * @test
     */
    public function job_should_pass_when_phoneNumber_exists()
    {
        $this->assertEquals($this->client->getPhoneNumber(),$this->phone);
    }
}
