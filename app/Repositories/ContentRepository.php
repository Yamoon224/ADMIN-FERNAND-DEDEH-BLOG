<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository extends BaseRepository
{
    public function __construct(Content $model)
    {
        parent::__construct($model);
    }

    public function findByDaily(int $dailyId)
    {
        return $this->model->where('daily_id', $dailyId)->get();
    }

    public function findByHashtag(int $hashtagId)
    {
        return $this->model->where('hashtag_id', $hashtagId)->get();
    }
}
