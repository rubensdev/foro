<?php

namespace App\Http\Controllers;

// Sintaxis de PHP 7, importar varias clases en una sola línea
use App\{Comment, Post};
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function store(Request $request, Post $post)
	{
		$comment = new Comment([
			'comment' => $request->get('comment'),
			'post_id' => $post->id
		]);

		auth()->user()->comments()->save($comment);

		return redirect($post->url);
	}
}
