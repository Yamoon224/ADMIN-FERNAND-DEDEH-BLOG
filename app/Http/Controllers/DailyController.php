<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyRequest;
use App\Http\Requests\UpdateDailyRequest;
use App\Repositories\DailyRepository;
use App\Http\Resources\DailyResource;
use App\Repositories\HashtagRepository;

class DailyController extends Controller
{
    protected $repository;
    protected $hashtagRepository;

    public function __construct(DailyRepository $repository, HashtagRepository $hashtagRepository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
        $this->hashtagRepository = $hashtagRepository;
    }

    public function index()
    {
        $dailies = $this->repository->all(['user', 'contents']);
        return view('dailies.index', compact('dailies'));
    }

    public function create()
    {
        $hashtags = $this->hashtagRepository->all();
        return view('dailies.add', compact('hashtags'));
    }

    public function store(StoreDailyRequest $request)
    {
        $daily = $this->repository->create($request->validated());
        return redirect()->route('dailies.index');
    }

    public function show($id)
    {
        $daily = $this->repository->find($id, ['user', 'contents']);
        return new DailyResource($daily);
    }

    public function update(UpdateDailyRequest $request, $id)
    {
        $daily = $this->repository->update($id, $request->validated());
        return redirect()->route('dailies.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('dailies.index');
    }
}
