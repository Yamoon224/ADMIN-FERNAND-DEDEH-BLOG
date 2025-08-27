<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository
{
    public function all(array $with = [])
    {
        return Group::with($with)->get();
    }

    public function find(int $id, array $with = [])
    {
        return Group::with($with)->findOrFail($id);
    }

    public function create(array $data): Group
    {
        return Group::create($data);
    }

    public function update(Group $group, array $data): Group
    {
        $group->update($data);
        return $group;
    }

    public function delete(Group $group): bool
    {
        return $group->delete();
    }
}
