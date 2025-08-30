<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Repositories\ContentRepository;
use App\Http\Resources\ContentResource;

class ContentController extends Controller
{
    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
    }

    public function index()
    {
        $contents = $this->repository->all(['hashtag', 'daily', 'user']);
        return view('contents', compact('contents'));
    }

    public function store(StoreContentRequest $request)
    {
        $content = $this->repository->create($request->validated());
        return redirect()->route('contents.index');
    }

    public function show($id)
    {
        $content = $this->repository->find($id, ['hashtag', 'daily', 'user']);
        return new ContentResource($content);
    }

    public function update(UpdateContentRequest $request, $id)
    {
        $content = $this->repository->update($id, $request->validated());
        return redirect()->route('contents.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('contents.index');
    }
}
