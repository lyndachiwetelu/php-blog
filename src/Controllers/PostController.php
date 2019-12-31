<?php declare(strict_types=1);


namespace App\Controllers;

use App\Repositories\PostRepository;

class PostController
{
	protected $repository;

	public function __construct(PostRepository $postRepository)
	{
		$this->repository = $postRepository;
	}

	public function addPost($vars=[])
	{
		$title = $_POST['title'] ?? '';
		$content = $_POST['content'] ?? '';
		$post = $this->repository->addPost($title, $content);
		header('Location: ' . APP_URL.'admin?postAdded=true');
	}
}