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

    public function testStoreValid()
    {
        $params = [
            "title" => "Valid Title",
            "content" => "At least 10 characters"
        ];

        $this->post("/posts", $params)
            ->assertStatus(302)
            ->assertSessionHas("status");

        $this->assertEquals(session("status"), "The blog post was created!");
    }

    public function testStoreFail()
    {
        $params = [
            "title" => "x",
            "content" => "x"
        ];

        $this->post("/posts", $params)
            ->assertStatus(302)
            ->assertSessionHas("errors");

        $messages = session("errors")->getMessages();
        $this->assertEquals($messages["title"][0], "The title field must be at least 5 characters.");
        $this->assertEquals($messages["content"][0], "The content field must be at least 10 characters.");
    }
}
