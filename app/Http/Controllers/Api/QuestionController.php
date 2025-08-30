<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    protected $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/questions",
     *     operationId="getQuestionsList",
     *     tags={"Questions"},
     *     summary="Get list of questions",
     *     description="Returns a list of questions with their comments and creator",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Question Title"),
     *                 @OA\Property(property="body", type="string", example="Question body"),
     *                 @OA\Property(
     *                     property="comments",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Comment")
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
        return QuestionResource::collection($this->repository->all(['user', 'comments']));
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = $this->repository->create($request->validated());
        return new QuestionResource($question);
    }

    public function show($id)
    {
        $question = $this->repository->find($id, ['user', 'comments']);
        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, $id)
    {
        $question = $this->repository->update($id, $request->validated());
        return new QuestionResource($question);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
