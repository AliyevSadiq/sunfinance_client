<?php


namespace App\Services\Client\Virtual;

/**
 * @OA\Schema(
 *     title="Client Store",
 *     description="Client model",
 *     @OA\Xml(
 *         name="Client Store"
 *     )
 * )
 */
class ClientRequest
{
    /**
     * @OA\Property(
     *      title="Client firstName",
     *      description="Client firstName",
     *      type="string",
     *      example="John"
     * )
     */
    public string $firstName;

    /**
     * @OA\Property(
     *      title="Client lastName",
     *      description="Client lastName",
     *      type="string",
     *      example="Doe"
     * )
     */
    public string $lastName;


    /**
     * @OA\Property(
     *      title="Client email",
     *      description="Client email",
     *      type="string",
     *      example="john.doe@mail.com"
     * )
     */
    public string $email;


    /**
     * @OA\Property(
     *      title="Client phoneNumber",
     *      description="Client phoneNumber",
     *      type="string",
     *      example="+37101234567"
     * )
     */
    public string $phoneNumber;

}
