<?php

require_once '../src/Repositories/UserRepository.php';

use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$username = $_POST['username'];
	$email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);

    $newUser = new UserRepository;
    $newUser->saveUser($password,$email,$username);

	header("Location: login.php");
}

?>

<!doctype html>
<html lang="en">
    
<head class="title">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Newco.Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full bg-gray-100">

<h2 class="mt-6 text-3xl tracking-tight font-bold text-white text-center">NewCo.Register</h2>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-md rounded-lg px-12 py-8">
            <form class="w-full max-w-lg mt-6" action="" method="POST">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                            Username
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Enter username" id = "username" name="username" required>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" placeholder="Enter email" id = "email" name="email" required>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" placeholder="Enter password" id = "password" name="password" required>
                    </div>
                </div>

                <div class="mt-6 text-center flex justify-center">
                    <p class="text-gray-700 mb-2">Already have an account?</p>
                    <a class="font-bold text-blue-500 hover:text-blue-700 ml-2" href="/../views/login.php">Login here</a>
                </div>
                
                <div class="flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" name="register">
                        Register
                    </button>
                </div>
            </form>
            
        </div>
    </div>

</body>
</html>

<style>
.bg-gray-100 {
    background-color: #1F2937;
}

.shadow-md {
    box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.1), 0px 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.rounded {
    border-radius: 0.25rem;
}

.px-12 {
    padding-left: 3rem;
    padding-right: 3rem;
}

.py-8 {
    padding-top: 2rem;
    padding-bottom: 2rem;
}

.mt-6 {
    margin-top: 1.5rem;
}
</style>