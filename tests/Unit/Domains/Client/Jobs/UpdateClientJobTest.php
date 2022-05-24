<?php

namespace Tests\Unit\Domains\Client\Jobs;

use App\Data\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domains\Client\Jobs\UpdateClientJob;

class UpdateClientJobTest extends TestCase
{

    use RefreshDatabase,WithFaker;


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

    }
    /**
     * @test
     */
    public function job_should_pass_when_model_exists()
    {
        $client=Client::factory()->create()->first();
        $this->assertModelExists($client);
    }

    /**
     * @test
     */
    public function job_should_pass_when_firstName_updated()
    {
        $client=Client::factory()->create()->first();
        $firstName=$client->getFirstName();
        $this->executeUpdateClientJob($client,$this->name,$client->getLastName(),$client->getPhoneNumber(),$client->getEmail());
        $this->assertNotEquals($client->getFirstName(),$firstName);
    }

    /**
     * @test
     */
    public function job_should_pass_when_lastName_updated()
    {
        $client=Client::factory()->create()->first();
        $lastName=$client->getLastName();
        $this->executeUpdateClientJob($client,$client->getFirstName(),$this->name,$client->getPhoneNumber(),$client->getEmail());
        $this->assertNotEquals($client->getLastName(),$lastName);
    }


    /**
     * @test
     */
    public function job_should_pass_when_phoneNumber_updated()
    {
        $client=Client::factory()->create()->first();
        $phoneNumber=$client->getPhoneNumber();
        $this->executeUpdateClientJob($client,$client->getFirstName(),$client->getLastName(),$this->phone,$client->getEmail());
        $this->assertNotEquals($client->getPhoneNumber(),$phoneNumber);
    }

    /**
     * @test
     */
    public function job_should_pass_when_email_updated()
    {
        $client=Client::factory()->create()->first();
        $email=$client->getEmail();
        $this->executeUpdateClientJob($client,$client->getFirstName(),$client->getLastName(),$client->getPhoneNumber(),$this->email);
        $this->assertNotEquals($client->getEmail(),$email);
    }


    private function executeUpdateClientJob(Client $client, string $firstName,string $lastName, string $phoneNumber, string $email)
    {
        $job=new UpdateClientJob($client, $firstName,$lastName, $phoneNumber, $email);
        $job->handle();
    }
}
