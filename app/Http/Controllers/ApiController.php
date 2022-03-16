<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Repositories\Implementations\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepo) {
        $this->userRepository = $userRepo;
    }

     /**
     * @OA\Get(
     *     tags={"API"},
     *     path="/api/v1/contacts",
     *     description="List all contacts paginated",
     *     operationId="getContacts",
     * @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by name, lastname, phone number or address",
     *         required=false,
     *      ),
     * @OA\Response(
     *    response=200,
     *    description="Successful Response",
     *    @OA\JsonContent(@OA\Property(property="data", type="Json", example="[...]"),
     *        )
     * ),
     * * @OA\Response(
     *    response=401,
     *    description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *     ),
     * )
     */
    public function getContacts(Request $request) {
        $contacts = $this->userRepository->getContactsInformationPaginated($request);
        
        return response()->json($contacts, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     tags={"API"},
     *     path="/api/v1/contacts/register",
     *     description="Register contact info with phone numbers and address",
     * @OA\RequestBody(
     *    required=true,
     *     @OA\MediaType(mediaType="application/json",
     *       @OA\Schema( required={"first_name","last_name","phones", "addresses"},
     *                  @OA\Property(property="first_name", type="string", example="Juan "),
     *                  @OA\Property(property="last_name", type="string", example="Perez Ortiz"),
     *                  @OA\Property(
     *                      property="phones",
     *                      type="array",
     * *                    @OA\Items(
     *                          type="string",
     *                          description="Phones",
     *                          example="829-999-9999",
     *                          @OA\Schema(type="string")
     *                          ),
     *                          description="Store phones"
     *                   ),
     *                  @OA\Property(
     *                      property="addresses",
     *                      type="array",
     * *                    @OA\Items(
     *                          type="string",
     *                          description="Phones",
     *                          example="Calle#1",
     *                          @OA\Schema(type="string")
     *                          ),
     *                          description="Store address"
     *                   ),
     *       ),
     *      ),
     *   ),
     * @OA\Response(
     *    response=201,
     *    description="Successful Stored",
     *    @OA\JsonContent(@OA\Property(property="data", type="Json", example="[...]"),
     *        )
     * ),
     * * @OA\Response(
     *    response=401,
     *    description="Bad Request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *     ),
     * )
     */
    public function registerContact(CreateContactRequest $request) {

        try {
            $contact = $this->userRepository->create($request->all());
            $contact = $this->userRepository->createMany($request->only('phones', 'addresses'), $contact);

            return response()->json(['message' => 'Data added', 'status' => true], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
