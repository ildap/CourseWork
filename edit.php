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
            #подключение к бд
            $dbhost = "192.168.1.106:3300";
            $dbusername = "root";
            $dbpass = "";
            $dbconnect = mysqli_connect($dbhost, $dbusername, $dbpass);

            $maxid = mysqli_query($dbconnect,
                'SELECT max(id) FROM mysitedb.printers;');
            $maxid = $maxid->fetch_assoc();
            $maxid = intval($maxid['max(id)']);
            #если был пост запрос то нужно вставить или обновить данные
            if ($_POST) {
                #экранизация спец символов в параметрах
                $id = mysqli_real_escape_string($dbconnect, $_POST['id']);
                $model = mysqli_real_escape_string($dbconnect, $_POST['model']);
                $type = mysqli_real_escape_string($dbconnect, $_POST['type']);
                $price = mysqli_real_escape_string($dbconnect, $_POST['price']);
                $description = mysqli_real_escape_string($dbconnect, $_POST['description']);
                $resolution = mysqli_real_escape_string($dbconnect, $_POST['resolution']);
                $scale = mysqli_real_escape_string($dbconnect, $_POST['scale']);
                $speed = mysqli_real_escape_string($dbconnect, $_POST['speed']);
                #если ид существут то формируем запрос на обновление
                if ($id > 0 and $id <= $maxid) {
                    $query = "update mysitedb.printers set
                      model='$model',
                      type='$type',
                      price='$price',
                      description='$description',
                      resolution='$resolution',
                      scale='$scale',
                      speed='$speed' where id='$id';";
                #а иначе - на вставку
                } else {
                    $query = "insert into mysitedb.printers (model,type,price,description,resolution,scale,speed)
                          values ('$model','$type','$price','$description','$resolution','$scale','$speed');";
                }

                mysqli_query($dbconnect,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                if(mysqli_query($dbconnect,$query)){echo '<p>ok</p>';}


            } else {
                $type = "";
                $model = "";
                $price = "";
                $description = "";
                $scale = "";
                $resolution = "";
                $speed = "";
                if ($_GET) {
                    $id = intval($_GET['id']);
                    /*если запрос с гет параметром, значит пользователь
                    хочет отредактировать описание товара, и поля формы будут заполнены
                    текущими данными*/
                    if ($id > 0 and $id <= $maxid) {
                        mysqli_query($dbconnect,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                        $printer = mysqli_query($dbconnect,
                            "SELECT * FROM mysitedb.printers where id=$id");
                        $printer = $printer->fetch_assoc();
                        $type = $printer['type'];
                        $price = $printer['price'];
                        $model = $printer['model'];
                        $scale = $printer['scale'];
                        $resolution = $printer['resolution'];
                        $speed = $printer['speed'];
                        $description = $printer['description'];

                    } else {
                        $id = $maxid + 1;
                    }
                } else {
                    #иначе запрос без параметра,пустые поля
                    $id = $maxid + 1;
                }
                echo "<form method='post' action='edit.php'>
                        <input type='hidden' name='id' value='$id'>

            <div>
                <p style='text-align: center'><b>Модель<input type='text' name='model' value='$model' maxlength='50'></b></p></br>
            </div>
            <div class='fqw'>
                <div>
                    <div class='img2'>
                        <img src='static/$id.jpg'>
                        <p style='text-align:  center;'><a href='edit.php'><b><input type='submit' value='сохранить'></b></a></p>
                    </div>

                    <div class='tableblock'>

                        <table>

                            <tr>
                            <td><b>цена</b></td><td><b><input type='text' name='price' value='$price' >руб.</b></td>
                            </tr>
                            <tr>
                                <td><b>скорость печати</b></td><td><b><input type='text' name='speed' value='$speed'>стр/мин</b></td>
                            </tr>
                            <tr>
                                <td><b>формат</b></td><td><input type='text' name='scale' value='$scale' maxlength='4'></td>
                            </tr>
                            <tr>
                                <td><b>тип</b></td><td><input type='text' name='type' value='$type' maxlength='50'></td>
                            </tr>
                            <tr>
                                <td><b>разрешение</b></td><td><b><input type='text' name='resolution' value='$resolution'>dpi</b></td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
            <div>
                Описание
                <textarea name='description' rows='10' cols='50' maxlength='1000'>$description</textarea>
            </div>
            </form>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>