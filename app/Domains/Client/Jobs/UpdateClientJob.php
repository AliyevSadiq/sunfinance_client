<?php

namespace App\Domains\Client\Jobs;

use App\Data\Models\Client;
use Lucid\Units\Job;

class UpdateClientJob extends Job
{
    private Client $client;
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Client $client,string $firstName, string $lastName, string $phoneNumber, string $email)
    {
        //
        $this->client = $client;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }

    /**
     * @return Client
     */
    public function handle(): Client
    {
        $this->client->setFirstName($this->firstName)
            ->setLastName($this->lastName)
            ->setPhoneNumber($this->phoneNumber)
            ->setEmail($this->email)
            ->save();
        return $this->client;
    }
}
