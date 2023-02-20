<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Post;
use App\Repositories\PostsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsRepositoryTests extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app(PostsRepository::class);
    }

    /** @test */
    public function it_can_retrieve_all_posts()
    {
        $posts = Post::factory()->count(3)->create();

        $result = $this->repository->all();

        $this->assertCount(3, $result);
        $this->assertEquals($posts->pluck('id')->toArray(), $result->pluck('id')->toArray());
    }

    /** @test */
    public function it_can_find_a_post_by_id()
    {
        $post = Post::factory()->create();

        $result = $this->repository->find($post->id);

        $this->assertEquals($post->id, $result->id);
    }

    /** @test */
    public function it_can_create_a_post()
    {
        $data = Post::factory()->make()->toArray();

        $result = $this->repository->create($data);

        $this->assertDatabaseHas('posts', $data);
        $this->assertEquals($data['title'], $result->title);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $post = Post::factory()->create();
        $data = ['title' => 'Updated Title'];

        $result = $this->repository->update($data, $post->id);

        $this->assertDatabaseHas('posts', $data);
        $this->assertEquals($data['title'], $result->title);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $post = Post::factory()->create();

        $result = $this->repository->delete($post->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    /** @test */
    public function it_can_retrieve_all_posts_with_relations()
    {
        $posts = Post::factory()->count(3)->create();

        $result = $this->repository->allWithRelations();

        $this->assertCount(3, $result);
        $this->assertEquals($posts->pluck('id')->toArray(), $result->pluck('id')->toArray());
        $this->assertTrue($result->first()->relationLoaded('author'));
    }
}