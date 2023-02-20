<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;

class UserRepositoryTests extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepository(new User);
    }

    public function test_all_method_returns_collection()
    {
        $users = $this->userRepository->all();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $users);
    }

    public function test_find_method_returns_user_by_id()
    {
        $user =  $user = User::factory()->count(3)->create();

        $foundUser = $this->userRepository->find($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
    }

    public function test_create_method_creates_user_in_database()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ];

        $createdUser = $this->userRepository->create($userData);

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($userData['name'], $createdUser->name);
        $this->assertEquals($userData['email'], $createdUser->email);
    }

    public function test_update_method_updates_user_record()
    {
        $user = User::factory()->count(3)->create();

        $updateData = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ];

        $this->userRepository->update($updateData, $user->id);

        $updatedUser = User::find($user->id);

        $this->assertEquals($updateData['name'], $updatedUser->name);
        $this->assertEquals($updateData['email'], $updatedUser->email);
    }

    public function test_delete_method_deletes_user_record()
    {
        $user = User::factory()->count(3)->create();

        $this->userRepository->delete($user->id);

        $deletedUser = User::find($user->id);

        $this->assertNull($deletedUser);
    }

    public function test_all_with_relations_method_returns_collection_with_relations()
    {
        $user = User::factory()->count(3)->create();
        $user->posts()->create(['name' => 'posts']);

        $users = $this->userRepository->allWithRelations();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $users);
        $this->assertTrue($users->contains($user));
        $this->assertNotNull($users->find($user->id)->relation1);
        $this->assertNotNull($users->find($user->id)->relation2);
    }
}