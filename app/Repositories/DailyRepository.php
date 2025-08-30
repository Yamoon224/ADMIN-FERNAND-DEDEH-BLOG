<?php

namespace App\Repositories;

use App\Models\Daily;

class DailyRepository extends BaseRepository
{
    public function __construct(Daily $model)
    {
        parent::__construct($model);
    }
}
