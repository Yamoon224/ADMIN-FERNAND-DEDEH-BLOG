<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use App\Http\Resources\GroupResource;

class GroupController extends Controller
{
    protected $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin']);
        $this->repository = $repository;
    }

    public function index()
    {
        $groups = $this->repository->all();
        return view('groups', compact('groups'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = $this->repository->create($request->validated());
        return redirect()->route('groups.index');
    }

    public function show($id)
    {
        $group = $this->repository->find($id);
        return new GroupResource($group);
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        $group = $this->repository->update($id, $request->validated());
        return redirect()->route('groups.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('groups.index');
    }
}
