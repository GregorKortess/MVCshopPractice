<?php

class UserController
{
    public function actionRegister()
    {
        $name = "";
        $email = "";
        $password = "";

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!USER::checkName($name)) {
                $errors[] = "Имя не должно быть короче 2-х символов";
            }

            if (!USER::checkEmail($email)) {
                $errors[] = "Неправильный email";
            }

            if (!USER::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов";
            }

            if (USER::checkEmailExists($email)) {
                $errors[] = "Такой email уже зарегестрирован";
            }


            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }

        }

        require_once ROOT . '/views/user/register.php';

        return true;
    }

    public function actionLogin()
    {
        $email = "";
        $password = "";

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;
            if (!USER::checkEmail($email)) {
                $errors[] = "Неправильный email";
            }

            if (!USER::checkPassword($password)) {
                $errors[] = "Пароль не должен быть короче 6-ти символов";
            }
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email,$password);

            if ($userId == false) {
                // Если данные не правильные показываем ошибку
                $errors[] = "Неправильные данные для входа на сайт";
            } else {
                // Если данные верные запоминаем пользователя в сессии
                User::auth($userId);

                // Перенаправляем пользователя в кабинет
                header("Location: /cabinet/");
            }
        }
        require_once (ROOT. '/views/user/login.php');
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /");
    }
}