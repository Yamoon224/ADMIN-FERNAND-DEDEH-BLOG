<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Repositories\ContentRepository;
use App\Http\Resources\ContentResource;

class ContentController extends Controller
{
    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/contents",
     *     operationId="getContentsList",
     *     tags={"Contents"},
     *     summary="Get list of contents",
     *     description="Returns a list of contents with associated hashtag, daily, and user",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="body", type="string", example="Content text"),
     *                 @OA\Property(property="path_image", type="string", example="/images/content1.jpg"),
     *                 @OA\Property(property="hashtag_id", type="integer", example=3),
     *                 @OA\Property(
     *                     property="hashtag",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=3),
     *                     @OA\Property(property="hashtag", type="string", example="Economie")
     *                 ),
     *                 @OA\Property(property="daily_id", type="integer", example=2),
     *                 @OA\Property(
     *                     property="daily",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=2),
     *                     @OA\Property(property="published_at", type="string", format="date-time")
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
        return ContentResource::collection($this->repository->all(['hashtag', 'daily', 'user']));
    }

    public function store(StoreContentRequest $request)
    {
        $content = $this->repository->create($request->validated());
        return new ContentResource($content);
    }

    public function show($id)
    {
        $content = $this->repository->find($id, ['hashtag', 'daily', 'user']);
        return new ContentResource($content);
    }

    public function update(UpdateContentRequest $request, $id)
    {
        $content = $this->repository->update($id, $request->validated());
        return new ContentResource($content);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
