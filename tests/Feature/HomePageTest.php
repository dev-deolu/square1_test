<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A Guest User can visit the homepage
     * @return void
     */
    public function test_guest_user_can_visit_homepage()
    {
        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('welcome');
    }

    /**
     * A Guest User can view posts on the homepage
     * @return void
     */
    public function test_guest_user_can_view_posts_on_homepage()
    {
        // Firstly create atleast a user
        \App\Models\User::factory(10)->create();
        // Then create atleast one post
        $posts = \App\Models\Post::factory(2)->create();
        // Visit the homepage
        $response = $this->get('/');
        $response->assertViewIs('welcome');
        // Assert status of page is 200
        $response->assertStatus(200);
        // Assert users can see posts created
        foreach ($posts as $key => $post) {
            $response->assertSee($post->title, $post->description, $post->publication_date);
        }
    }

    /**
     * A Guest User can sort posts by publication date the homepage
     * @return void
     */
    public function test_guest_user_can_sort_posts_by_publication_date()
    {
        // Firstly create atleast a user to assign posts to
        \App\Models\User::factory()->create();
        // Then create atleast one post
        $post1 = \App\Models\Post::factory()->create([
            'publication_date' => '10/05/2021',
        ]);

        $post2 = \App\Models\Post::factory()->create([
            'publication_date' => '01/02/2022',
        ]);
        // Visit the homepage
        $response = $this->from('/')->get('/?date_from=01/01/2022&date_to=03/01/2022');
        $response->assertSee($post2->title, $post2->description);
        $response->assertDontSee($post1->title, $post1->description);
    }

    /**
     * An authenticated User can visit the homepage
     * @return void
     */
    public function test_authenticated_user_can_visit_homepage()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertSuccessful();
        $response->assertViewIs('welcome');
    }

    /**
     * An authenticated User can view posts on the homepage
     * @return void
     */
    public function test_authenticated_user_can_view_posts_on_homepage()
    {
        $user = \App\Models\User::factory()->create();
        // Then create atleast one post
        $posts = \App\Models\Post::factory(2)->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertViewIs('welcome');
        $response->assertStatus(200);
        // Assert users can see posts created
        foreach ($posts as $post) {
            $response->assertSee($post->title, $post->description, $post->publication_date);
        }
    }

    /**
     * An authenticated User can sprt posts by publication date on the homepage
     * @return void
     */
    public function test_authenticated_user_can_sort_posts_by_publication_date()
    {
        // Firstly create atleast a user to assign posts to
        $user = \App\Models\User::factory()->create();
        // Then create atleast one post
        $post1 = \App\Models\Post::factory()->create([
            'publication_date' => '10/05/2021',
        ]);

        $post2 = \App\Models\Post::factory()->create([
            'publication_date' => '01/02/2022',
        ]);
        // Visit the homepage
        $response = $this->actingAs($user)->from('/')->get('/?date_from=01/01/2022&date_to=03/01/2022');
        $response->assertSee($post2->title, $post2->description);
        $response->assertDontSee($post1->title, $post1->description);
    }
}
