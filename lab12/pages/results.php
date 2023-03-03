<?php
require "../config.php";
session_start();

$w=0;

function pushDataJson($data){
    $json_data = json_decode(file_get_contents('../images.json'),true);

    foreach($data as $answer){
        $json_data['groups'][$answer['question']][$answer['quality']*3-2]['answers']['weight']+=intval($answer['img1']);
        $json_data['groups'][$answer['question']][$answer['quality']*3-1]['answers']['weight']+=intval($answer['img2']);
        $json_data['groups'][$answer['question']][$answer['quality']*3]['answers']['weight']+=intval($answer['img3']);

        $json_data['groups'][$answer['question']][$answer['quality']*3-2]['answers']['count']+=1;
        $json_data['groups'][$answer['question']][$answer['quality']*3-1]['answers']['count']+=1;
        $json_data['groups'][$answer['question']][$answer['quality']*3]['answers']['count']+=1;
    }
    file_put_contents('../images.json', json_encode($json_data));
}
pushDataJson($_SESSION['answers']);

function showResults(){
    global $w;
    $json_data = json_decode(file_get_contents('../images.json'),true);
    $sum_rank=0;
    $sum_count=0;

    foreach($json_data['groups'] as $group){
        ?><ul><?php
        foreach($group as $item){
            ?><li><?php
                echo "Объект: ".$item["name"]."; Качество: ".$item["quality"]."; Сумма рангов: ".$item["answers"]["weight"]."; Количество ответов: ".$item["answers"]["count"];
                $sum_rank+=$item["answers"]["weight"];
                $sum_count+=$item["answers"]["count"];
            ?></li><?php
        }
        ?></ul><?php
    }
    $w=$sum_count/$sum_rank/pi()*5;
}

?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ШевченкоГО 214-322</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Montserrat:400,500,700|Playfair+Display:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet">
    <link href="../style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="temp-header">
        <h2>Отчет</h2>
    </div>
    
    <div class="main-block">

        <div class="result">
            <br>
            <?php showResults();?>
        </div>

        <button type="button" class="btn btn-primary btn-lg" onClick='location.href="../index.php"'>Начать заново</button>

    </div>
</body>

</html>