<?php

declare(strict_types=1);

//use Lina\AdsWebsite\Router;
use Bramus\Router\Router;
use Lina\AdsWebsite\Controller\AdsController;
use Lina\AdsWebsite\Controller\AuthController;

require './vendor/autoload.php';

session_start();
$router = new Router();

$router->match('GET', '/ads/list', function () {
    (new AdsController())->showList();
});
$router->match('GET', '/ads/create', function () {
    (new AdsController())->showCreateAd();
});
$router->match('POST', '/ads/create', function () {
    (new AdsController())->handleCreateAd();
});
$router->match('GET', '/ads/my', function () {
    (new AdsController())->showMyAds();
});
$router->match('GET', '/ads/liked', function () {
    (new AdsController())->showLikedAds();
});
$router->match('POST', '/ads/(\d+)/unlike', function ($id) {
    (new AdsController())->handleUnlike((int) $id);
});
$router->match('GET', '/ads/(\d+)/like', function ($id) {
    (new AdsController())->handleLike((int) $id);
});
$router->match('GET', '/ads/(\d+)/edit', function ($id) {
    (new AdsController())->showEdit((int) $id);
});
$router->match('POST', '/ads/(\d+)/edit', function ($id) {
    (new AdsController())->handleEdit((int) $id);
});
$router->match('POST', '/ads/(\d+)/delete', function ($id) {
    (new AdsController())->handleDelete((int) $id);
});

$router->match('GET', '/login', function () {
    (new AuthController())->showLogin();
});
$router->match('POST', '/login', function () {
    (new AuthController())->handleLogin();
});
$router->match('GET', '/logout', function () {
    (new AuthController())->logout();
});
$router->match('GET', '/registration', function () {
    (new AuthController())->showRegistration();
});
$router->match('POST', '/registration', function () {
    (new AuthController())->handleRegistration();
});
$router->match('GET', '/style.css', function () {
    require './view/style.css';
    header('Content-Type: text/css');
});
$router->match('GET', '/', function () {
    require './view/page.php';
});

$router->run();
