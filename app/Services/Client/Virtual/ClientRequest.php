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
     *      example="first name test"
     * )
     */
    public string $firstName;

    /**
     * @OA\Property(
     *      title="Client lastName",
     *      description="Client lastName",
     *      type="string",
     *      example="last name test"
     * )
     */
    public string $lastName;


    /**
     * @OA\Property(
     *      title="Client email",
     *      description="Client email",
     *      type="string",
     *      example="email@bk.ru"
     * )
     */
    public string $email;


    /**
     * @OA\Property(
     *      title="Client phoneNumber",
     *      description="Client phoneNumber",
     *      type="string",
     *      example="aosdgoauisdgaosd"
     * )
     */
    public string $phoneNumber;

}
