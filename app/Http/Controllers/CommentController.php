<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    protected $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->middleware(['auth', 'verified']);
        $this->repository = $repository;
    }

    public function index()
    {
        $comments = $this->repository->all();
        return view('comments', compact('comments'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->repository->create($request->validated());
        return redirect()->route('comments.index');
    }

    public function show($id)
    {
        $comment = $this->repository->find($id);
        return new CommentResource($comment);
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = $this->repository->update($id, $request->validated());
        return redirect()->route('comments.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('comments.index');
    }
}
