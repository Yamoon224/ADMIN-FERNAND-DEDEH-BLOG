<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHashtagRequest;
use App\Http\Requests\UpdateHashtagRequest;
use App\Repositories\HashtagRepository;
use App\Http\Resources\HashtagResource;

class HashtagController extends Controller
{
    protected $repository;

    public function __construct(HashtagRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/hashtags",
     *     operationId="getHashtagsList",
     *     tags={"Hashtags"},
     *     summary="Get list of hashtags",
     *     description="Returns a list of hashtags with their contents and creator",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="hashtag", type="string", example="Economie"),
     *                 @OA\Property(
     *                     property="contents",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Content")
     *                 ),
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Alice")
     *                 ),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function index()
    {
        return HashtagResource::collection($this->repository->all(['user', 'contents']));
    }

    public function store(StoreHashtagRequest $request)
    {
        $hashtag = $this->repository->create($request->validated());
        return new HashtagResource($hashtag);
    }

    public function show($id)
    {
        $hashtag = $this->repository->find($id, ['user', 'contents']);
        return new HashtagResource($hashtag);
    }

    public function update(UpdateHashtagRequest $request, $id)
    {
        $hashtag = $this->repository->update($id, $request->validated());
        return new HashtagResource($hashtag);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
