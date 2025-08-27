<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all(array $with = [])
    {
        return Category::with($with)->get();
    }

    public function find(int $id, array $with = [])
    {
        return Category::with($with)->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): Category
    {
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
