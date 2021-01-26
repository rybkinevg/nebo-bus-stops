<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if (!defined('INSTALLED') && get_page() !== 'install') header('Location: /install/install.php');

if (isset($_COOKIE['auth'])) {

    if (get_page() === 'sign-in' || get_page() === 'sign-up') header('Location: /');
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

if (isset($_POST['sign-in'])) {

    $db = new db(HOST, USER, PASSWORD, DB_NAME);

    $user = $db->select(USERS_TABLE, false, '*', "`login` = '{$_POST['login']}'");

    if (is_array($user)) {

        if ($user[0]['password'] === $_POST['password']) {

            setcookie("auth", 'true', time() + 60 * 60 * 24 * 30);
            setcookie("id", $user[0]['ID'], time() + 60 * 60 * 24 * 30);

            header("Location: /");
        }
    }
}

if (isset($_POST['sign-up'])) {

    $err = array();

    # проверям логин

    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['user_login'])) {

        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if (strlen($_POST['user_login']) < 3 || strlen($_POST['user_login']) > 30) {

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    # проверяем, не сущестует ли пользователя с таким именем

    $db = new db(HOST, USER, PASSWORD, DB_NAME);

    $user = $db->select(USERS_TABLE, false, '*', "`login` = '{$_POST['user_login']}'");

    if ($user) {

        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    # Если нет ошибок, то добавляем в БД нового пользователя

    if (count($err) == 0) {

        $date = date("Y-m-d H:i:s");

        $db->insert('users', "NULL, '{$_POST['user_login']}', '{$_POST['user_password']}', '{$date}', '{$_POST['user_first_name']}', '{$_POST['user_last_name']}', DEFAULT, DEFAULT");

        header("Location: /sign-in.php");

        exit();
    } else {

        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach ($err as $error) {

            print $error . "<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Интерактивный помощник | Установка</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <?php

    echo get_favicon($page);

    $styles = enqueue_styles($page);

    foreach ($styles as $key => $value) {

        echo "<link rel='stylesheet' id='css-{$key}' href='{$value}'>";
    }

    ?>

</head>


<body>