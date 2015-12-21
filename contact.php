<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <title>Интернет магазин принтеров</title>
    <link rel="stylesheet" href="static/style.css">

</head>
<body>
<div class="menu1 color">
    <div class="menu">
        <p class="brend"><a href="main.php">Print Store</a></p>
        <p class="mEl">Добавить товар</p>
    </div>
    <p class="mEl2"><a href="contact.html">Обратная связь</a></p>
    <p class="mEl2"><a href="conctacts.html">Контактные данные</a></p>
</div>
<div class="content">
    <div>
        <div class='center'>
            <?php
                if ($_POST){
                    $f = fopen('log.txt','a',true);
                    date_default_timezone_set('Etc/GMT-5');
                    $date = date('Y/m/d H:m:s');
                    fwrite($f,$_POST['message']."\n");
                    fwrite($f,"дата: ".$date."\n\n");
                    fclose($f);
                    echo '<p><b>Спасибо за отзыв!</b></p>';
                }

            ?>
        </div>

    </div>
</div>
</body>
</html>