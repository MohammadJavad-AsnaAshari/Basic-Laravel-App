<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testNoBlogPostsWhenNothingInDatabase(): void
    {
        $response = $this->get('/posts');

        $response->assertSeeText("No blog posts yet!");
    }

    public function testSeeOneBlogPostWhenThereIsOne()
    {
        // Arrange
        $post = new BlogPost();
        $post->title = "New Title";
        $post->content = "Content of the blog Post";
        $post->save();

        // Act
        $response = $this->get("/posts");

        // Assert
        $response->assertSeeText("New Title");

        $this->assertDatabaseHas("blog_posts", [
            "title" => "New Title"
        ]);
    }
}
