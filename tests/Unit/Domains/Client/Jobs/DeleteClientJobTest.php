<?php

namespace Tests\Unit\Domains\Client\Jobs;

use App\Data\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domains\Client\Jobs\DeleteClientJob;

class DeleteClientJobTest extends TestCase
{

    use RefreshDatabase,WithFaker;

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
    public function job_should_pass_when_data_deleted()
    {
        $client=Client::factory()->create()->first();
        $this->assertEquals(true,$client->delete());
    }

}
