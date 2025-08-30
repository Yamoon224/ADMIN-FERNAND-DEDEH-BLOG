<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    protected $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/comments",
     *     operationId="getCommentsList",
     *     tags={"Comments"},
     *     summary="Get list of comments",
     *     description="Returns a list of comments with their associated question and user",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="comments", type="string", example="This is a comment"),
     *                 @OA\Property(property="question_id", type="integer", example=5),
     *                 @OA\Property(
     *                     property="question",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=5),
     *                     @OA\Property(property="body", type="string", example="Question body")
     *                 ),
     *                 @OA\Property(
     *                     property="user",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=2),
     *                     @OA\Property(property="name", type="string", example="John Doe")
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
        return CommentResource::collection($this->repository->all(['user', 'question']));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->repository->create($request->validated());
        return new CommentResource($comment);
    }

    public function show($id)
    {
        $comment = $this->repository->find($id, ['user', 'question']);
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = $this->repository->update($id, $request->validated());
        return new CommentResource($comment);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
