<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Get all users with optional relations.
     */
    public function all(array $with = [])
    {
        return User::with($with)->get();
    }

    /**
     * Find user by id.
     */
    public function find(int $id, array $with = [])
    {
        return User::with($with)->findOrFail($id);
    }

    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        if(!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
            unset($data['password_confirmation']);
        }
        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function update(int $id, array $data): User
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user (soft delete).
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
