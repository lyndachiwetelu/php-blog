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

	public function addComment($postId)
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$comment = $_POST['comment'];
		$commentWithUser = $this->repository->addComment($username, $email, $comment, $postId);
		header('Location: '.APP_URL."post/$postId");
	}

}