<?php

declare(strict_types=1);

namespace App\Services\Client\Http\Controllers;

use App\Data\Models\Client;
use App\Services\Client\Features\{DeleteClientFeature, GetClientFeature, StoreClientFeature, UpdateClientFeature};
use App\Traits\WithTransaction;
use Lucid\Units\Controller;

class ClientController extends Controller
{
    use WithTransaction;


    /**
     * @OA\Post(
     *      path="/api/clients",
     *       tags={"Clients"},
     *      summary="Store new client",
     *      description="Returns client data",
     *      @OA\RequestBody(
     *          required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ClientRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#")
     *       ),
     *     )
     */
    public function store()
    {
        return $this->serveFeature(StoreClientFeature::class);
    }

    /**
     * @OA\Get(
     *      path="/api/clients/{client}",
     *     tags={"Clients"},
     *      summary="Get client information",
     *      description="Return client data",
     *      @OA\Parameter(
     *          name="client",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#")
     *       )
     * )
     */
    public function show(Client $client)
    {
        return $this->serveFeature(GetClientFeature::class, [
            'client' => $client
        ]);
    }

    /**
     * @OA\Put(
     *      tags={"Clients"},
     *      path="/api/clients/{client}",
     *      summary="Update existing client",
     *      description="Returns updated client data",
     *      @OA\Parameter(
     *          name="client",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ClientRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#")
     *       )
     * )
     */
    public function update(Client $client)
    {
        return $this->serveFeature(UpdateClientFeature::class, [
            'client' => $client
        ]);
    }

    /**
     * @OA\Delete(
     *      tags={"Clients"},
     *      path="/api/clients/{client}",
     *      summary="Delete existing client",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="client",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       )
     * )
     */
    public function destroy(Client $client)
    {
        return $this->serveFeature(DeleteClientFeature::class, [
            'client' => $client
        ]);
    }
}
