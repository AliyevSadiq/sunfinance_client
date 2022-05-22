<?php



namespace App\Domains\Client\Jobs;

use App\Data\Models\Client;
use Lucid\Units\Job;

class DeleteClientJob extends Job
{
    private Client $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        //
        $this->client = $client;
    }

    /**
     * Execute the delete client job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->delete();
    }
}
