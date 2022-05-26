<?php

declare(strict_types=1);

namespace App\Services\Client\Features;

use App\Data\Models\Client;
use App\Domains\Client\Jobs\UpdateClientJob;
use App\Domains\Client\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Response;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class UpdateClientFeature extends Feature
{

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param ClientStoreRequest $request
     * @return mixed
     */
    public function handle(ClientStoreRequest $request)
    {
        $client = $this->run(UpdateClientJob::class, [
            'client' => $this->client,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
        ]);

        return $this->run(new RespondWithJsonJob([
            'client' => new ClientResource($client)
        ], Response::HTTP_ACCEPTED));
    }
}
