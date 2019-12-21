<?php declare(strict_types=1);


namespace App\Controllers;

use App\Repositories\PostRepository;

class PostController
{
	protected static $repository;

	private static function setRepository()
	{
		self::$repository = new PostRepository;
	}

	public function addPost($vars=[])
	{
		$title = $_POST['title'] ?? '';
		$content = $_POST['content'] ?? '';
		self::setRepository();
		$post = self::$repository->addPost($title, $content);
		header('Location: ' . APP_URL.'admin?postAdded=true');
	}
}