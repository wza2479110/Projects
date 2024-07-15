<?php
  use src\Repositories\ArticleRepository;
    use src\Repositories\UserRepository;

  require_once '../src/Repositories/ArticleRepository.php';
  $article = (new ArticleRepository())->getAllArticles();

?>
<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Article</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="h-full">

<?php require_once 'nav.php'?>
<h2 class="mt-6 text-3xl tracking-tight font-bold text-gray-900" align="center">All Article</h2>
<div class="mx-auto max-w-2xl  sm:px-6 lg:px-8">

<?php echo count($article) === 0 ? "No article yet." : ""; ?>

<div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">

  <?php foreach ($article as $article): ?>
            <li class="">
                <div class="inline-block">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class=" flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="truncate">

                                    <div class="flex text-sm">

                                    <a href="<?= $article->url ?>"><strong><?= $article->title ?></strong></a><br> 
                                    
                                    </div>

                                    <div class="mt-2 flex">
                                        <div class="flex items-center text-sm text-gray-500">
                                        
                                            <!-- Heroicon name: mini/calendar -->
                                            <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                                      clip-rule="evenodd"/>
                                            </svg>

                                            <div class="truncate">
                                                <div class="flex-wrap text-sm">
                                                    <?php if ($article->updated_at !== null) { ?>
                                                        <p class="time">
                                                            Created at 
                                                            <time datetime="2020-01-07"><?= $article->created_at ?></time>
                                                        </p>
                                                        <p class="time">
                                                            Update at 
                                                            <time datetime="2020-01-07"><?= $article->updated_at ?></time>
                                                        </p>
                                                    <?php } else { ?>
                                                        <p class="time">
                                                            Created at 
                                                            <time datetime="2020-01-07"><?= $article->created_at ?></time>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="userInfo">
                    <a style="display: flex; align-items: center;">
                        <?php
                            $author_id = $article->author_id; 
                            $author = (new UserRepository())->getUserById($author_id);
                            echo '<img class="user_icon" src="/images/'.$author->profile_picture.'" alt="User Icon">';
                            echo $author->name;                    
                        ?>
                    </a>                          
                </div>
                
                </div>


                
                <div class="inline-block float-right mt-8 mr-4">                                           
                    <a href="update_article.php? id=<?= isset($article) ? $article->id : '' ?>" class="inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="black" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                        </svg>
                    </a>

                    <a href="delete_article.php? id=<?= isset($article) ? $article->id : '' ?>" class="inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="red" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                    </a>
                </div>
            </li>
  <?php endforeach; ?>

    </ul>
</div>

</div>
</body>
</html>

<style>
.userInfo
{
    padding-left: 20px;
}

img {
  width: 25px;
  height: 25px;
  margin-right: 10px;
  border-radius: 50%;
}
</style>
