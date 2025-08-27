<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use App\Http\Resources\GroupResource;

class GroupController extends Controller
{
    protected $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return GroupResource::collection($this->repository->all());
    }

    public function store(StoreGroupRequest $request)
    {
        $group = $this->repository->create($request->validated());
        return new GroupResource($group);
    }

    public function show($id)
    {
        $group = $this->repository->find($id);
        return new GroupResource($group);
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $group = $this->repository->update($id, $request->validated());
        return new GroupResource($group);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->noContent();
    }
}
