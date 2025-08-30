<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExclusivityRequest;
use App\Http\Requests\UpdateExclusivityRequest;
use App\Repositories\ExclusivityRepository;
use App\Http\Resources\ExclusivityResource;

class ExclusivityController extends Controller
{
    protected $repository;

    public function __construct(ExclusivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/exclusivities",
     *     operationId="getExclusivitiesList",
     *     tags={"Exclusivities"},
     *     summary="Get list of exclusivities",
     *     description="Returns a list of exclusivities with their creator",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Exclusive Article"),
     *                 @OA\Property(property="body", type="string", example="Exclusive content body"),
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
        return ExclusivityResource::collection($this->repository->all(['user']));
    }

    public function store(StoreExclusivityRequest $request)
    {
        $exclusivity = $this->repository->create($request->validated());
        return new ExclusivityResource($exclusivity);
    }

    public function show($id)
    {
        $exclusivity = $this->repository->find($id, ['user']);
        return new ExclusivityResource($exclusivity);
    }

    public function update(UpdateExclusivityRequest $request, $id)
    {
        $exclusivity = $this->repository->update($id, $request->validated());
        return new ExclusivityResource($exclusivity);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
