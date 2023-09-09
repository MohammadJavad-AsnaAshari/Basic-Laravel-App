<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
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
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get("/posts");

        // Assert
        $response->assertSeeText("New Title");
        $response->assertSeeText("No comments yet!");

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

    public function testUpdateValid()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas("blog_posts", $post->toArray());

        $params = [
            "title" => "A new named title",
            "content" => "Content was changed"
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas("status");

        $this->assertEquals(session("status"), "Blog post was updated!");
        $this->assertDatabaseMissing("blog_posts", $post->toArray());
        $this->assertDatabaseHas("blog_posts", [
            "title" => "A new named title"
        ]);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas("blog_posts", $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas("status");

        $this->assertEquals(session("status"), "Blog post was deleted!");
        $this->assertDatabaseMissing("blog_posts", $post->toArray());
    }

    public function testSeeOneBlogPostWithComment()
    {
        // Arrange
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(5)->create([
            "blog_post_id" => $post->id
        ]);

        // Act
        $response = $this->get("/posts");
        $response->assertSeeText("5 comments");
    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = "New Title";
        $post->content = "Content of the blog Post";
        $post->save();

        return $post;
    }
}
