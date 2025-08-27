<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->middleware(['auth', 'verified', 'admin.blogger']);
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->all();
        return view('categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->repository->create($request->validated());
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = $this->repository->find($id);
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->repository->update($id, $request->validated());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('categories.index');
    }
}
