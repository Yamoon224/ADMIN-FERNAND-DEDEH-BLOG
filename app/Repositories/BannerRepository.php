<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository
{
    public function all(array $with = [])
    {
        return Banner::with($with)->orderByDesc('id')->get();
    }

    public function paginate(array $positions = [], array $with = [], int $page = 10)
    {
        return Banner::with($with)->whereIn('position', $positions)->paginate($page);
    }

    public function find(int $id, array $with = [])
    {
        return Banner::with($with)->findOrFail($id);
    }

    public function create(array $data): Banner
    {
        return Banner::create($data);
    }

    public function update(int $id, array $data): Banner
    {
        $banner = Banner::find($id);
        $banner->update($data);
        return $banner;
    }

    public function delete(string $id): bool
    {
        $banner = Banner::find($id);
        return $banner->delete();
    }
}
