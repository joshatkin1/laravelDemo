<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostsRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * This fetches all posts
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->post->all();
    }

    /**
     * This finds a specified post
     *
     * @param int|string $id
     * @return mixed
     */
    public function find(int|string $id): mixed
    {
        return $this->post->findOrFail($id);
    }

    /**
     * This creates a new post
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->post->create($data);
    }

    /**
     * This updates a specified post
     *
     * @param array $data
     * @param int|string $id
     * @return mixed
     */
    public function update(array $data, $id): mixed
    {
        $post = $this->post->findOrFail($id);

        $post->update($data);

        return $post;
    }

    /**
     * This deletes a specified post
     *
     * @param int|string $id
     * @return mixed
     */
    public function delete(int|string $id): mixed
    {
        $post = $this->post->findOrFail($id);

        return $post->delete();
    }

    /**
     * This fetches all posts with all relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allWithRelations(): Collection|array
    {
        return $this->post->with($this->post->relations)->get();
    }
}