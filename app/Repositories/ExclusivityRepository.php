<?php

namespace App\Repositories;

use App\Models\Exclusivity;

class ExclusivityRepository extends BaseRepository
{
    public function __construct(Exclusivity $model)
    {
        parent::__construct($model);
    }
}
