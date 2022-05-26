<?php

declare(strict_types=1);

namespace App\Domains\Client\Jobs;

use App\Data\Models\Client;
use Lucid\Units\Job;

class StoreClientJob extends Job
{
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $firstName, string $lastName, string $phoneNumber, string $email)
    {
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
        $client = new Client();
        $client->setFirstName($this->firstName)
            ->setLastName($this->lastName)
            ->setPhoneNumber($this->phoneNumber)
            ->setEmail($this->email)
            ->save();
        return $client;
    }
}
