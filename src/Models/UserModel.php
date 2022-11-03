<?php

namespace Vita\Booking\Models;

use Vita\Booking\Services\DatabaseService;

class UserModel
{
    public function register(array $params): void
    {
        $database = new DatabaseService('users');
        $users = $database->get();

        $userName = strtolower(trim($params['username']));
        $email = strtolower(trim($params['email']));
        $phoneNumber = trim($params['mobile_number']);
        $firstPassword = trim($params['password']);
        $secondPassword = trim($params['confirm_password']);

        $matchUser = array_filter($users, function ($user) use ($userName, $email) {
            return $user['user'] === $userName && $user['email'] === $email;
        });

        if ($matchUser) {
            throw new \Exception('User already registered. Try to login');
        }

        if (!$this->validateUsername($userName)) {
            throw new \Exception('Your user name format is invalid, use only letters');
        }

        if (!$this->validateEmail($email)) {
            throw new \Exception('Your email format is invalid');
        }

        if (!$this->validatePhoneNumber($phoneNumber)) {
            throw new \Exception('Your phone number format is invalid');
        }

        if (!$this->validatePassword($firstPassword)) {
            throw new \Exception('Your password is too simple. Use more than 8 symbols and there should be 
            one or more lowercase and uppercase letters, digit and any of these symbols - !@#\$%\^&\*');
        }

        if ($firstPassword !== $secondPassword) {
            throw new \Exception('Your passwords do not match. Please enter the same password in both password fields.');
        }

        if (!$matchUser && $this->validatePassword($firstPassword) &&
            $this->validateEmail($email) && $this->validateUsername($userName) &&
            $this->validatePhoneNumber($phoneNumber) && $firstPassword === $secondPassword) {

            $hashedPassword = $this->encodePassword($firstPassword);

            $newUser = [
                'user' => $userName,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'password' => $hashedPassword,
                'user_type' => $params['type']
            ];

            $database->store($newUser);
        }
    }

    public function validateUsername(string $newUsername): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $newUsername);
    }

    public function validateEmail(string $email): bool
    {
        return preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/', $email);
    }

    public function validatePhoneNumber(string $phoneNumber): bool
    {
        return preg_match('/^\+?[0-9]{9,12}$/', $phoneNumber);
    }

    public function validatePassword(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password);
    }

    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function login(string $userName, string $email, string $password): void
    {
        $checkName = strtolower(trim($userName));
        $checkPassword = trim($password);
        $checkEmail = strtolower(trim($email));
        $userData = new DatabaseService('users');
        $users = $userData->get();

        $matchUser = array_filter($users, function ($user) use ($checkName, $checkPassword, $checkEmail) {
            return $user['user'] === $checkName && $user['email'] === $checkEmail
                && $this->encodePassword($checkPassword);
        });

        if (!$matchUser) {
            throw new \Exception('There is no user with this name, email and password');
        }
    }
}
