<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Repositories\GroupRepository;

class UserController extends Controller
{
    protected $repository;
    protected $groupRepository;

    public function __construct(UserRepository $repository, GroupRepository $groupRepository)
    {
        $this->middleware(['auth', 'verified', 'admin']);
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $users = $this->repository->all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $groups = $this->groupRepository->all();
        return view('users.add', compact('groups'));
    }

    public function edit(int $id)
    {
        $groups = $this->groupRepository->all();
        $user = $this->repository->find($id);
        return view('users.edit', compact('groups', 'user'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->repository->create($request->validated());
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = $this->repository->find($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->repository->update($id, $request->validated());
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('users.index');
    }
}
