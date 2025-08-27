<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function all(array $with = [], $type = 'ARTICLE')
    {
        $query = Article::with($with);

        if ($type !== '*') {
            $query->where('type', $type);
        }

        return $query->get();
    }

    public function paginate(array $with = [], $type = 'ARTICLE', int $page = 10)
    {
        $query = Article::with($with);

        if ($type !== '*') {
            $query->where('type', $type);
        }

        return $query->paginate($page);
    }


    public function find(int $id, array $with = [])
    {
        return Article::with($with)->findOrFail($id);
    }

    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function update(int $id, array $data): Article
    {
        $article = Article::find($id);
        $article->update($data);
        return $article;
    }

    public function delete(Article $article): bool
    {
        return $article->delete();
    }
}
