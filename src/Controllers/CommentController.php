<?php declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\CommentRepository;

class CommentController
{
	protected $repository;

	public function __construct(CommentRepository $commentRepository)
	{
		$this->repository = $commentRepository;
	}

	public function addComment($postId, $request)
	{
		$username = $request->get('username'); 
		$email = $request->get('email');
		$comment = $request->get('comment');
		$commentWithUser = $this->repository->addComment($username, $email, $comment, $postId);
		header('Location: '.APP_URL."post/$postId");
	}

}