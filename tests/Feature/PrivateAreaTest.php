<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrivateAreaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The private area requires login
     *
     * @return void
     */
    public function test_the_private_areas_require_login()
    {
        // Private area to view personal post
        $this->get('/home')->assertRedirect('/login');
        // Private area to view form to create a post
        $this->get('posts/create')->assertRedirect('/login');
        // Private area to submit a post
        $this->post('posts/store')->assertRedirect('/login');
    }

    /**
     * A Guest user can not visit the private area
     *
     * @return void
     */
    public function test_authenticated_user_can_visit_private_areas()
    {
        $user =  \App\Models\User::factory()->create();
        $this->actingAs($user)->get('/home')->assertOk();
        $this->actingAs($user)->get('posts/create')->assertOk();
    }

    /**
     * An authenticated user can view only their posts
     *
     * @return void
     */
    public function test_authenticated_user_can_view_only_their_posts()
    {
        \App\Models\User::factory(10)->create();
        $notUserPost = \App\Models\Post::factory()->create();

        $user =  \App\Models\User::factory()->create();
        $userPost = \App\Models\Post::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->get('/home');
        $response->assertSee($userPost->title, $userPost->description, $userPost->publication_date);
        $response->assertDontSee($notUserPost->title, $notUserPost->description, $notUserPost->publication_date);
    }

    /**
     * An authenticated user can view only their posts
     *
     * @return void
     */
    public function test_authenticated_user_can_create_post()
    {
        $user =  \App\Models\User::factory()->create();
        $response = $this->from('posts/create')->actingAs($user)->post('posts/store', [
            'title' => 'created for  user to see',
            'description' => 'Can you confirm i can see all needed data page',
            'publication_date' => '2021-02-10',
        ]);
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Post Created Successfully!');
    }
}
