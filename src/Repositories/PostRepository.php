<?php declare(strict_types=1);


namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;

class PostRepository
{
	public function getPosts() : array
	{
		$posts = Post::whereNotNull('id')->orderBy('created_at', 'desc')->get();
		$data = [];
		foreach ($posts as $post) {
			$commentCount = $post->comments->count();
			$post = $post->toArray();
			$post['comment_count'] = $commentCount;
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

	public function getSinglePost($postId) : array
	{
		$post = Post::find($postId);
		return $post->toArray();
	}

	public function editPost($postId, $title, $content) : bool
	{
		$post = Post::find($postId);
		$post->title = $title;
		$post->content = $content;
		$saved = $post->save();
		return $saved;
	}
}