<?php



namespace App\Services\Client\Features;

use App\Domains\Client\Jobs\StoreClientJob;
use App\Domains\Client\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Units\Feature;

class StoreClientFeature extends Feature
{
    /**
     * @param ClientStoreRequest $request
     * @return mixed
     */
    public function handle(ClientStoreRequest $request)
    {
        $client=$this->run(StoreClientJob::class,[
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'phoneNumber'=>$request->phoneNumber,
        ]);

        return $this->run(new RespondWithJsonJob([
            'client' => new ClientResource($client)
        ],Response::HTTP_CREATED));
    }
}
