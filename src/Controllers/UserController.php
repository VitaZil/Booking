<?php

namespace Vita\Booking\Controllers;

use Exception;
use Vita\Booking\Models\UserModel;

class UserController
{
    public static function createRegister(): void
    {
        require(__DIR__ . '/../../view/user-forms/register.php');
    }

    public static function createLogin(): void
    {
        require(__DIR__ . '/../../view/user-forms/login.php');

    }

    public static function register(array $params): void
    {
        $userModel = new UserModel();

        $message = '';

        try {
            $userModel->register($params);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        if (strlen($message) > 0) {
            require(__DIR__ . '/../../view/user-forms/register.php');
        }
        if (strlen($message) === 0) {
            header('Location: /login');
        }
    }

    public static function login(array $params): void
    {
        $userModel = new UserModel();

        $message = '';
        try {
            $userModel->login($params['username'], $params['email'], $params['password']);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        if (strlen($message) > 0) {
            require(__DIR__ . '/../../view/user-forms/login.php');
        }
        if (strlen($message) === 0) {
            header('Location: /apartments');
            $_SESSION['username'] = $params['username'];
        }
    }

    public static function logout(): void
    {
        session_destroy();
        header('Location: /apartments');
    }
}
