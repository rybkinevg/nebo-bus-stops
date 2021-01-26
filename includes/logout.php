<?php

if ($_GET['exit'] == 'true') {

    if (isset($_COOKIE['auth'])) {

        unset($_COOKIE['auth']);

        setcookie('auth', null, -1, '/');
    }

    if (isset($_COOKIE['id'])) {

        unset($_COOKIE['id']);

        setcookie('id', null, -1, '/');
    }

    header("Location: /");
}
