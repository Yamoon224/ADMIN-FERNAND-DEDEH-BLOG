<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function all(array $with = [])
    {
        return Comment::with($with)->get();
    }

    public function find(int $id, array $with = [])
    {
        return Comment::with($with)->findOrFail($id);
    }

    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(int $id, array $data): Comment
    {
        $comment = Comment::find($id);
        $comment->update($data);
        return $comment;
    }

    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }
}
