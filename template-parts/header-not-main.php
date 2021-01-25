<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if (!defined('INSTALLED') && get_page() !== 'install') header('Location: /install/install.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

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