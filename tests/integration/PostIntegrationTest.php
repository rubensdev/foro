<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostIntegrationTest extends TestCase
{
	
	use DatabaseTransactions;

	function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $post = factory(Post::class)->create(['title' => 'Cómo instalar Laravel']);

        /*$this->seeInDatabase('posts', [
        	'slug' => 'como-instalar-laravel'
        ]);*/

        // $this->assertSame('como-instalar-laravel', $post->slug);

        $this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
