<?php
require_once '../src/Repositories/UserRepository.php';
use src\Repositories\UserRepository;

session_start();

if (isset($_POST['submit'])) 
{
    // Get form data
    $userRepository = new UserRepository();
    $user = null;
    if (isset($_SESSION['user_id'])) 
    {
        if(isset($_POST['profile-picture']))
        $user = $userRepository->getUserById($_SESSION['user_id']);
        $newUsername = $_POST['username'];
        $newEmail = $_POST['email'];
        $newProfilePicture = $_POST['profile-picture'];
        $userRepository->updateUser($user->id, $newEmail, $newUsername, $newProfilePicture);
    } 
    else 
    {
        // redirect to login page 
        header("Location:login.php");
        exit;
    }

    // Check if the updated user is the same as the logged in user
    if ($user->id !== $_SESSION['user_id']) {
        $_SESSION['error'] = 'You can only update your own profile.';
        header("Location: setting.php");
        exit;
    }

    header("Location:index.php");
    exit;
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <?php require_once 'nav.php' ?>
    <h2 class="mt-6 text-3xl tracking-tight font-bold text-gray-900" align="center">User Profile</h2>
    
<form class="w-full max-w-lg mx-auto my-8" action="" method="POST">

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" value= <?= isset($user) ? $user->email : '' ?> name="email" required>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="name" value= <?= isset($user) ? $user->name : '' ?> name="username" required>
                </div>
            </div>

    <div class="flex items-center">
        <img class="user_icon" src="/images/<?= isset($user) ? $user->profile_picture : '' ?>">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 ml-2" for="username">
            Photo
        </label>
    </div>

    <div class="flex flex-wrap">
        <label for="profile-pic" class="w-full">
            Profile Picture
        </label>
        <input type="file" id="profile-picture" value="<?= isset($user) ? $user->profile_picture : '' ?>" name="profile-picture" class="w-full">
    </div>

            <div class="flex justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" name="submit">
                    Update
                </button>
            </div>
    </form>
</body>
</html>

<style>
.user_icon 
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
}
</style>