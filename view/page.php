<?php
use Lina\AdsWebsite\Repository\UsersRepository;


$email = null;
$userId = $_SESSION['user_id'] ?? null;
if (isset($userId)) {
    $user = (new UsersRepository())->findOneById($userId);
    if ($user !== null) {
        $email = $user['email'];
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Ads website</title>
    <link rel="stylesheet" href="/view/style.css">
</head>
<body>
<nav>
    <h2>
        <a href="/">Best ads website</a>
    </h2>
    <div>
        <?php if ($userId !== null): ?>
            <div>
                <a href="/ads/create">Create ad</a>
            </div>
            <div>
                <a href="/ads/my">My ads</a>
            </div>
            <div>
                <a href="/ads/liked">Liked ads</a>
            </div>
        <?php endif; ?>
        <div>
            <a href="/ads/list">List ads</a>
        </div>
        <?php if ($userId === null): ?>
            <div>
                <a href="/login">Login</a>
            </div>
            <div>
                <a href="/registration">Register</a>
            </div>
        <?php else: ?>
            <div>
                <a href="/logout">Logout</a>
            </div>
            <div>
                <?= $email ?>
            </div>
        <?php endif; ?>
    </div>
</nav>
<div>
    <?php if (isset($inner)): ?>
        <?php /** @var string $inner */
        require $inner; ?>
    <?php endif; ?>
</div>
</body>
</html>