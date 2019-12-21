<?php declare(strict_types=1);


namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;

class CommentRepository
{
	public function addComment($username, $email, $comment, $postId) : array
	{
		$user = User::firstOrCreate(['name' => $username, 'email' => $email]);
		$comment = Comment::create([
			'user_id' => $user->id,
			'post_id' => $postId,
			'content' => $comment]);
		return ['comment' => $comment, 'user' => $user];
	}

}