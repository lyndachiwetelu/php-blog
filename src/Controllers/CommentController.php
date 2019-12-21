<?php declare(strict_types=1);


namespace App\Controllers;

use App\Repositories\CommentRepository;

class CommentController
{
	protected static $repository;

	private static function setRepository()
	{
		self::$repository = new CommentRepository;
	}

	public function addComment($vars=[])
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$comment = $_POST['comment'];
		$postId = $vars['postId'];
		self::setRepository();
		$commentWithUser = self::$repository->addComment($username, $email, $comment, $postId);
		header('Location: '.APP_URL."post/$postId");
	}

}