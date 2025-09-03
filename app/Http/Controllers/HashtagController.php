<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHashtagRequest;
use App\Http\Requests\UpdateHashtagRequest;
use App\Repositories\HashtagRepository;
use App\Http\Resources\HashtagResource;

class HashtagController extends Controller
{
    protected $repository;

    public function __construct(HashtagRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
    }

    public function index()
    {
        $hashtags = $this->repository->all(['user', 'contents']);
        return view('hashtags', compact('hashtags'));
    }

    public function store(StoreHashtagRequest $request)
    {
        $hashtag = $this->repository->create($request->validated());
        return redirect()->route('hashtags.index');
    }

    public function show($id)
    {
        $hashtag = $this->repository->find($id, ['user', 'contents']);
        return new HashtagResource($hashtag);
    }

    public function update(UpdateHashtagRequest $request, $id)
    {
        $hashtag = $this->repository->update($id, $request->validated());
        return redirect()->route('hashtags.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('hashtags.index');
    }
}
