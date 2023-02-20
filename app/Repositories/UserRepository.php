<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * This fetches all user models
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->user->all();
    }

    /**
     * This finds a particular user model
     *
     * @param int|string $id
     * @return mixed
     */
    public function find(int|string $id): mixed
    {
        return $this->user->find($id);
    }

    /**
     * This creates a user model
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->user->create($data);
    }

    /**
     * This updates a particular user
     *
     * @param array $data
     * @param int|string $id
     * @return mixed
     */
    public function update(array $data, int|string $id): mixed
    {
        $record = $this->user->find($id);
        return $record->update($data);
    }

    /**
     * This destroys a particular user
     *
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        return $this->user->destroy($id);
    }

    /**
     * This fethces all users with all their relations
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function allWithRelations(): Collection|array
    {
        return $this->user->with(relations: $this->user->relations)->get();
    }
}