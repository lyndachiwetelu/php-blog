<?php declare(strict_types=1);

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Repositories\PostRepository;

class ViewController
{
	protected static $twig;
	protected static $postRepository;

	private static function setLoader()
	{
		$loader = new FilesystemLoader(BASE_DIR. '/templates');
        self::$twig = new Environment($loader);
        self::$twig->addGlobal('stylesheet', APP_URL.'/templates/styles/style.css');
	}

	private static function setRepository()
	{
		self::$postRepository = new PostRepository;
	}

	public function list($vars=[])
	{
		self::setLoader();
		self::setRepository();
		$posts = self::$postRepository->getPosts();
		echo self::$twig->render('list.html.twig', ['posts' => $posts]);
	}

	public function singlePost($vars=[])
	{
		$postId = $vars['postId'] ?? '';
		self::setLoader();
		self::setRepository();
		$postWithComments = self::$postRepository->getSinglePostWithComments($postId);
		echo self::$twig->render('single.html.twig', ['post' => $postWithComments['post'], 'comments' => $postWithComments['comments']]);

	}

	public function admin($vars=[])
	{
		self::setLoader();
		$notification = (isset($_GET['postAdded']) && $_GET['postAdded'] === 'true')  ? 'Post Added!' : '';
		echo self::$twig->render('/admin/post.html.twig', ['notification' => $notification]);
	}
}