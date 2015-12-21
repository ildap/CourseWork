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
        <?php
        if ($_GET) {
            $dbhost = "192.168.1.106:3300";
            $dbusername = "root";
            $dbpass = "";
            $dbconnect = mysqli_connect($dbhost, $dbusername, $dbpass);
            mysqli_query($dbconnect, "SET character_set_results='utf8';");
            $maxid = mysqli_query($dbconnect,
                "SELECT max(id) FROM mysitedb.printers;");
            $maxid = $maxid->fetch_assoc();
            $maxid = $maxid['max(id)'];
            $id = intval($_GET['id']);

            if (0 < $id and $id <= $maxid) {
                $printer = mysqli_query($dbconnect,
                    "SELECT * FROM mysitedb.printers where id=$id");
                $printer = $printer->fetch_assoc();
    echo "<div class='center'>
            <div>
            <p style='text-align: center'><b>$printer[type] принтер $printer[model] </b></p>
            </div>
            <div class='fqw'>
                <div>
                    <div class='img2' style='float: left;'>
                        <img src='static/$printer[id].jpg'>
                        <p style='text-align:  center;'><a href='edit.php?id=$id'><b>Редактировать</b></a></p>
                        <p style='text-align:  center;'><a href='order.php?id=$id'><b>Оформить заказ</b></a></p>
                    </div>
                    <div class='tableblock'>
                        <table>

                            <tr>
                                <td><b>цена</b></td><td><b>$printer[price] руб.</b></td>
                            </tr>
                            <tr>
                                <td><b>скорость печати</b></td><td><b>$printer[speed] стр/мин</b></td>
                            </tr>
                            <tr>
                                <td><b>формат</b></td><td><b>$printer[scale]</b></td>
                            </tr>
                            <tr>
                                <td><b>тип</b></td><td><b>$printer[type]</b></td>
                            </tr>
                            <tr>
                                <td><b>разрешение</b></td><td><b>$printer[resolution] dpi</b></td>
                            </tr>
                        </table
                    </div>

                </div>
            </div>
            </div>
            <div class='qw'>
                <p>$printer[description]</p>
            </div></div>
        </div>";


            } else {
                echo "<h1>404 NO FOUND</h1>";
            }
        } else {
            echo "<h1>404 NO FOUND</h1>";
        }
        ?>




    </div>
</div>
</body>
</html>