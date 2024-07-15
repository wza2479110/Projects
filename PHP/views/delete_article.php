<?php
require_once __DIR__ .  '/../src/Repositories/ArticleRepository.php';
require_once __DIR__ . '/../src/Repositories/UserRepository.php';

use src\Repositories\ArticleRepository;
use src\Repositories\UserRepository;

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) 
	{
		$articleRepository = new ArticleRepository();
		$articlDeleted = $articleRepository->getArticleById($_GET['id']);

		$userRepository = new UserRepository();
		$user = $userRepository->getUserById($_SESSION['user_id']);

		if ($articlDeleted->author_id !== $user->id) 
		{
			echo "<script>alert('You are not the author of this article!');</script>";
			header('Location: index.php');
			exit;
		} 
		else {
			$articleRepository->deleteArticle($_GET['id']);
		}
		
		

	}
	header('Location: index.php');
}
?>