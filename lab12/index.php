<?php
// require "config.php";
session_start();
session_unset();
?>

<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ШевченкоГО 214-322</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Montserrat:400,500,700|Playfair+Display:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body >
    <div class="main-block">
        <h1>Система опроса</h1>
        <button type="button" class="btn btn-primary btn-lg" onClick='location.href="pages/test.php?question=1&period=1"'>Начать тест</button>
    </div>

</body>

</html>