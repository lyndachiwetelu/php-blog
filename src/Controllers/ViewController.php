<?php declare(strict_types=1);

namespace App\Controllers;

use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader;
use App\Repositories\PostRepository;

class ViewController
{
	protected $twig;
	protected $postRepository;

	public function __construct(PostRepository $postRepository, TwigEnvironment $twig)
	{
		$this->postRepository = $postRepository;
		$this->twig = $twig;
		$this->twig->addGlobal('stylesheet', APP_URL.'/src/Views/styles/style.css');
	}

	public function list()
	{
		$posts = $this->postRepository->getPosts();
		echo $this->twig->render('list.html.twig', ['posts' => $posts]);
	}

	public function singlePost($postId)
	{
		$postWithComments = $this->postRepository->getSinglePostWithComments($postId);
		echo $this->twig->render('single.html.twig', ['post' => $postWithComments['post'], 'comments' => $postWithComments['comments']]);

	}

	public function admin()
	{
		$notification = (isset($_GET['postAdded']) && $_GET['postAdded'] === 'true')  ? 'Post Added!' : '';
		echo $this->twig->render('/admin/post.html.twig', ['notification' => $notification]);
	}
}