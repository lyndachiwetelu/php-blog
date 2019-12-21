<?php declare(strict_types=1);


namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;

class PostRepository
{
	public function getPosts() : array
	{
		$posts = Post::all();
		$data = [];
		foreach ($posts as $post) {
			$comment_count = $post->comments->count();
			$post = $post->toArray();
			$post['comment_count'] = $comment_count;
			$data[] = $post;
		}
		return $data;
	}

	public function addPost($title, $content) : array
	{
		$post = Post::create(['title' => $title, 'content' => $content]);
		return $post->toArray();
	}

	public function getSinglePostWithComments($postId) : array
	{
		$post = Post::find($postId);
		$comments = Comment::with('user')->where('post_id', $postId)->get();
		return ['post' => $post->toArray(), 'comments' => $comments->toArray()];
	}
}