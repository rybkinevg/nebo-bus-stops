<?php

$file = ($_GET['file']) ? $_GET['file'] : false;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Интерактивный помощник по остановкам</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="body">
    <?php if ($file) include('./includes/exel-array-to-js.php'); ?>
    <div class="loader">
        <h1 class="loader__text">Загрузка меток на карте, пожалуйста, подождите</h1>
    </div>
    <div class="container">
        <nav class="nav">
            <ul>
                <li><button class="js-modal-trigger" data-modal="upload">Добавить метки</button></li>
                <li><button class="js-modal-trigger" data-modal="download">Скачать</button></li>
            </ul>
        </nav>
        <div id="map"></div>
    </div>
    <div class="modals">
        <div class="modal modal-upload">
            <div class="modal__inner">
                <button class="js-modal-close">Х</button>
                <div class="modal__content">
                    <form id="upload-form">
                        <div class="input-file-wrapper">
                            <input id="upload-file" type="file" name="upload-file">
                            <span class="import-submit-loader has-loader disabled">
                                <input id="upload-submit" type="submit" class="button" value="Загрузить" disabled>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal modal-download">
            <div class="modal__inner">
                <button class="js-modal-close">Х</button>
                <div class="modal__content">
                    <div class="input-file-wrapper">
                        <ul class="download-list">
                            <li>Ничего не найдено</li>
                        </ul>
                        <button class="js-download-update">Обновить данные</button>
                        <button class="js-download-submit" disabled>Скачать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=5571489d-8573-4ab6-8f61-558fd0453a57" type="text/javascript"></script>
    <script async src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script async src="./script.js" type="text/javascript"></script>
</body>

</html>