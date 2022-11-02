<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Controller;

use Lina\AdsWebsite\Repository\UsersRepository;

class AuthController extends Controller
{
    public function showRegistration(): void
    {
        $this->render('./view/registration.php');
    }

    public function handleRegistration(): void
    {
        $repository = new UsersRepository();

        $newUser = [
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'phone_number' => $_POST['phone_number'],
        ];
        $users = $repository->findAllByEmail($newUser['email']);

        if (count($users) > 0) {
            die('Provided email address is already taken.');
        }

        if ($_POST['password'] !== $_POST['password_repeat']) {
            die('Passwords do not match');
        }
        $repository->create($newUser);

        header('Location: /login');
    }

    public function showLogin(): void
    {
        $this->render('./view/login.php');
    }
    public function handleLogin(): void
    {
        $repository = new UsersRepository();
        $users = $repository->findAllByEmail($_POST['email']);
        if (count($users) > 0) {
            $user = reset($users);
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];

                header('Location: /ads/list');

                return;
            }
        }
        die('Invalid credentials');
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', 0, '/');

        header('Location: /login');
    }
}
