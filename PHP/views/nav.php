<?php
require_once '../src/Repositories/UserRepository.php';
require_once '../src/Models/User.php';

use src\Repositories\UserRepository;
use src\Models\User;

// Reusable navigation bar. You will need to use the UserRepository to show the name
// and start a session in order to determine the user authentication status e.g. checking $_SESSION['user_id']
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
function active($page): bool 
{
    $pageFromUri = explode('/', $_SERVER['REQUEST_URI']);
	return $page === end($pageFromUri);
}

$userRepository = new UserRepository;
$user = null;
if (isset($_SESSION['user_id'])) {
    $user = $userRepository->getUserById($_SESSION['user_id']);
}
?>

<header>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div>
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-900 lg:px-40 xl:px-24">
        <nav class="nav">
          <div class="left_links">
            <a><i class="title"></i>NewCo.</a>
            <a class="<?php echo (active('index.php') || active('update_article.php') || active('setting.php')) ? 'active' : '' ?>" href="index.php"><i class="links"></i>All Articles</a>
            <a class="<?php echo active('new_article.php') ? 'active' : '' ?>" href="new_article.php"><i class="links"></i>Add More Article</a>
          </div>
          <div class="right_links">
            <?php if (!isset($_SESSION['user_id'])) { ?>
              <a class="<?php echo active('login.php') ? 'active' : '' ?>" href="login.php"><i class="user"></i>Login</a>
              <a class="<?php echo active('register.php') ? 'active' : '' ?>" href="register.php"><i class="user"></i>Register</a>
            <?php } else { ?>
              <a class="<?php echo active('setting.php') ? 'active' : '' ?>" href="setting.php"><img class="user_icon" src="/images/<?= isset($user) ? $user->profile_picture : '' ?>" alt="User Icon">Welcome</a>
              <a class="<?php echo active('setting.php') ? 'active' : '' ?>" href="setting.php"><i class="user"></i><?= isset($user) ? $user->name : '' ?></a>
              <a class="<?php echo active('logout.php') ? 'active' : '' ?>" href="logout.php"><i class="user"></i>logout</a>
            <?php } ?>
</div>

</nav>
    </div>
</div>

</header>
<style>
.nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 50px;
  background-color: black;
  color: white;
  padding: 0 20px;
}

.nav a {
  display: flex;
  align-items: center;
  padding: 10px;
  text-decoration: none;
  font-size: 15px;
  color: white;
  height: 100%;
  margin: 0 10px;
}

.nav img {
  width: 20px;
  height: 20px;
  margin-right: 10px;
  border-radius: 50%;
}

.nav a:link:hover {
  background-color: blueviolet;
  color: white;
}

.left_links {
  display: flex;
  align-items: center;
  flex-shrink: 0;
}

.right_links {
  display: flex;
  align-items: center;
  flex-grow: 1;
  justify-content: flex-end;
}

table,
th,
td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

