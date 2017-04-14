<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowPostTest extends FeatureTestCase
{
    function test_a_user_can_see_the_post_details()
    {
        $user = $this->defaultUser(['name' => 'Rubens García']);

    	$post = $this->createPost([
    		'title' => 'Este es el título del post',
    		'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
    	]);

    	// When
    	$this->visit($post->url)
    		 ->seeInElement('h1', $post->title)
    		 ->see($post->content)
    		 ->see('Rubens García');
    }

    function test_old_urls_are_redirected()
    {
        // Having
        $post = $this->createPost([
            'title' => 'Old title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New Title']);

        $this->visit($url)
             ->seePageIs($post->url);
    }
}
