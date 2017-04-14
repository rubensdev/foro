<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostModelTest extends TestCase
{
    function test_adding_a_title_generates_a_slug()
    {
    	$title = 'Cómo instalar Laravel';
    	$post = new Post([
    		'title' => $title
    	]);

    	$this->assertSame(str_slug($title), $post->slug);
    }

    function test_editing_the_title_changes_the_slug()
    {
    	$title = 'Cómo instalar Laravel';
    	$post = new Post([
    		'title' => $title
    	]);

    	$newTitle = 'Cómo instalar Laravel 5.1 LTS';
    	$post->title = $newTitle;

    	$this->assertSame(str_slug($newTitle), $post->slug);
    }
}
