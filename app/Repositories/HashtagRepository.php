<?php

namespace App\Repositories;

use App\Models\Hashtag;

class HashtagRepository extends BaseRepository
{
    public function __construct(Hashtag $model)
    {
        parent::__construct($model);
    }

    public function findByHashtagName(string $name)
    {
        return $this->model->where('hashtag', $name)->first();
    }

    public function search(string $keyword)
    {
        return $this->model->where('hashtag', 'LIKE', "%{$keyword}%")->get();
    }
}
