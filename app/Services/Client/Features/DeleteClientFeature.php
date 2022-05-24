<?php

declare(strict_types=1);

namespace App\Services\Client\Features;

use App\Data\Models\Client;
use App\Domains\Client\Jobs\DeleteClientJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class DeleteClientFeature extends Feature
{

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $this->run(DeleteClientJob::class, ['client' => $this->client]);
        return $this->run(new RespondWithJsonJob([
            'message' => 'Client deleted'
        ],Response::HTTP_NO_CONTENT));
    }
}
