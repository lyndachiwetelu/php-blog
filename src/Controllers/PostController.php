<?php declare(strict_types=1);


namespace App\Controllers;

use App\Repositories\PostRepository;
use Twig\Environment as TwigEnvironment;
use App\Helpers\Request;

class PostController
{
	protected $repository;
	protected $twig;

	public function __construct(PostRepository $postRepository, TwigEnvironment $twig)
	{
		$this->repository = $postRepository;
		$this->twig = $twig;
	}

	public function list()
	{
		$posts = $this->repository->getPosts();
		echo $this->twig->render('list.html.twig', ['posts' => $posts]);
	}

	public function singlePost($postId)
	{
		$postWithComments = $this->repository->getSinglePostWithComments($postId);
		echo $this->twig->render('single.html.twig', ['post' => $postWithComments['post'], 'comments' => $postWithComments['comments']]);

	}

	public function adminAddPost(Request $request)
	{
		$postAdded = $request->get('postAdded') ?? false;
		$notification = ($postAdded === 'true')  ? 'Post Added!' : '';
		echo $this->twig->render('/admin/post.html.twig', ['notification' => $notification, 'action' => 'ADD']);
	}

	public function adminViewPosts(Request $request)
	{
		$postDeleted = $request->get('postDeleted') ?? false;
		$notification = ($postDeleted === 'true')  ? 'Post Deleted!' : '';
		$posts = $this->repository->getPosts();
		echo $this->twig->render('/admin/allposts.html', ['posts' => $posts, 'notification' => $notification]);
	}

	public function addPost(Request $request)
	{
		$title = $request->get('title') ?? '';
		$content = $request->get('content') ?? '';
		$postId = $request->get('postId') ?? '';
		if ($postId) {
			$this->repository->editPost($postId, $title, $content);
		} else {
			$post = $this->repository->addPost($title, $content);
		}
		header('Location: ' . APP_URL.'admin?postAdded=true');
	}

	public function editPost($postId)
	{
		$post = $this->repository->getSinglePost($postId);
		echo $this->twig->render('/admin/post.html.twig', ['post' => $post, 'action' => 'EDIT']);
	}

	public function deletePostConfirm($postId)
	{
		$post = $this->repository->getSinglePost($postId);
		echo $this->twig->render('/admin/confirm.html', ['post' => $post]);
	}

	public function deletePost($postId)
	{
		$this->repository->deletePost($postId);
		header('Location: ' . APP_URL.'admin/posts?postDeleted=true');
	}
}