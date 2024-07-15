<?php
use src\Repositories\ArticleRepository;
require_once '../src/Repositories/ArticleRepository.php';

session_start();

if (!isset($_SESSION['user_id'])) 
{
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$articleTitle = $_POST['title'];
    $articleUrl = $_POST['url'];
    $authorId = $_SESSION['user_id'];

	$article = (new ArticleRepository())->saveArticle($articleTitle, $articleUrl, $authorId);

    if ($article) 
    {
		header("Location: index.php");
	} 
    else 
    {
		header("Location: new_article.php"); // error handling omitted for this example
	}
}
?>
<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Article</title>
    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body class="h-full">

    <?php require_once 'nav.php' ?>
    <h2 class="mt-6 text-3xl tracking-tight font-bold text-gray-900" align="center">Add More Article</h2>

<div>

    <div class="mt-10">
        <div class="mx-auto max-w-2xl bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="new_article.php" method="POST">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700"> Article Title </label>
                    <div class="mt-1">
                        <input placeholder="A title for your Article"
                               id="title"
                               name="title"
                               type="text"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700"> Article URL </label>
                    <div class="mt-1">
                        <input placeholder="A URL for your Article"
                               id="url"
                               name="url"
                               type="text"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add!
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>

