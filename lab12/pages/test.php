<?php
// require "../config.php";
session_start();

$temp = file_get_contents("../questions.json");

$num_questions=3;
$questions = json_decode($temp, true);

$question = $_GET['question'] ?? null;
$period = $_GET['period'] ?? null;

if ($question != 1) {
    add_user_answer($question-1, $_GET['img1'], $_GET['img2'], $_GET['img3'], $period);
}

function add_user_answer($question, $img1, $img2, $img3, $period){
    $_SESSION['answers'][] = [
        'img1' => $img1,
        'img2' => $img2,
        'img3' => $img3,
        'question' => $question,
        'quality'=> $period
    ];
}

if ($period != null) {
    add_user_period($period);
}

function add_user_period($period)
{
    $_SESSION['period']=$period;
}
function print_answers($question, $period)
{
    $json_data = json_decode(file_get_contents('../images.json'),true);
    $count=intval($json_data['groups']['1']['1']['answers']['count']);
    if($question==4){
        $question=1;
        $period+=1;
        add_user_period($period);
    }
    if($period<=4){
        ?>
                <div class="card" style="width: 40rem;">
                    <img class="card-img-top" src="../images/<?php echo $question.'/'.($period).'/'.$question; ?> тон.jpg" alt="Card image cap">
                    <div class="card-body">
                        <input class="form-control" list="cock" name="img1">
                    </div>
                </div>
                <div class="card" style="width: 40rem;">
                    <img class="card-img-top" src="../images/<?php echo $question.'/'.($period).'/'.$question; ?> насыщенность.jpg" alt="Card image cap">
                    <div class="card-body">
                        <input class="form-control" list="cock" name="img2">
                    </div>
                </div>
                <div class="card" style="width: 40rem;">
                    <img class="card-img-top" src="../images/<?php echo $question.'/'.($period).'/'.$question; ?> яркость.jpg" alt="Card image cap">
                    <div class="card-body">
                        <input class="form-control" list="cock" name="img3">
                    </div>
                <datalist id="cock">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </datalist>
                <button type="submit" class="btn btn-primary">Далее</button>
                <input type="hidden" name="period" value="<?php echo $period; ?>">
                <?php 
    }
                else{
                    ?><button type="button" onClick='location.href="results.php"' class="btn btn-primary btn-lg">Готово</button> <?php

                }
                ?>
                <input type="hidden" name="question" value=<?php echo $question+1; ?>>
        <?php
    
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
    <div class="main-block">

        <h3>Разделите представленные ниже изображения по шкале от 1 до 3,</h3> 
        <h3>где 1 - наименее натуральное по цвету,</h3>
        <h3> а 3 - наиболее натуральное по цвету.</h3>
        
        <form class="questions_form" action="test.php" method="get">
            <div class="form-check">
                <?php 
                print_answers($question, $period);
                ?>
            </div>
        </form>
        <br>
        <button type="button" class="btn btn-primary btn-lg" onClick='location.href="../index.php"'>Начать заново</button>
    </div>
</body>
<script src="test.js"></script>

</html>