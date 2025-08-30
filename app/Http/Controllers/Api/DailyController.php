<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDailyRequest;
use App\Http\Requests\UpdateDailyRequest;
use App\Repositories\DailyRepository;
use App\Http\Resources\DailyResource;

class DailyController extends Controller
{
    protected $repository;

    public function __construct(DailyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/dailies",
     *     operationId="getDailiesList",
     *     tags={"Dailies"},
     *     summary="Get list of dailies",
     *     description="Returns a list of dailies with their contents and creator",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="published_at", type="string", format="date-time"),
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
        return DailyResource::collection($this->repository->all(['user', 'contents']));
    }

    public function store(StoreDailyRequest $request)
    {
        $daily = $this->repository->create($request->validated());
        return new DailyResource($daily);
    }

    public function show($id)
    {
        $daily = $this->repository->find($id, ['user', 'contents']);
        return new DailyResource($daily);
    }

    public function update(UpdateDailyRequest $request, $id)
    {
        $daily = $this->repository->update($id, $request->validated());
        return new DailyResource($daily);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
