<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_belongs_to_user()
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(User::class, $post->user);
        $this->assertEquals($post->user_id, $post->user->id);
    }

    public function test_post_has_many_comments()
    {
        $post = Post::factory()->create();
        Comment::factory()->count(3)->create(['post_id' => $post->id]);
        $this->assertCount(3, $post->comments);
        $this->assertInstanceOf(Comment::class, $post->comments->first());
    }

    public function test_soft_delete_on_post()
    {
        $post = Post::factory()->create();
        $post->delete();
        $this->assertSoftDeleted('posts', ['id' => $post->id]);
    }

}
