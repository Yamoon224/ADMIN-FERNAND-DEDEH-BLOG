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

    public function index()
    {
        return CommentResource::collection($this->repository->all());
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->repository->create($request->validated());
        return new CommentResource($comment);
    }

    public function show($id)
    {
        $comment = $this->repository->find($id);
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
