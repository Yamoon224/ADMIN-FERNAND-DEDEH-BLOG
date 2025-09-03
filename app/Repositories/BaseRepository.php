<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $with = [], array $conditions = [])
    {
        $query = $this->model::with($with);

        foreach ($conditions as $condition) {
            $query->where(...$condition);
        }

        return $query->get();
    }

    public function paginate(array $with = [], int $page = 10)
    {
        return $this->model->with($with)->orderByDesc('id')->paginate($page);
    }

    public function find(int $id, array $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $instance = $this->model->findOrFail($id);
        $instance->update($data);
        return $instance;
    }

    public function delete(string $id): bool
    {
        $obj = $this->model::find($id);
        return $obj->delete();
    }
}
