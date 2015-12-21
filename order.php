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

        <p class="mEl">Оформление заказа</p>
    </div>
    <p class="mEl2"><a href="contact.html">Обратная связь</a></p>

    <p class="mEl2"><a href='contacts.html'>Контактные данные</a></p>
</div>
<div class="content">
    <div>
        <div class='center'>
            <?php
            $dbhost = "192.168.1.106:3300";
            $dbusername = "root";
            $dbpass = "";
            $dbconnect = mysqli_connect($dbhost, $dbusername, $dbpass);
            # если метод пост с параметрами выполняется сохранение данных о заказе
            # иначе сформируется форма для оформления заказа
            if ($_POST) {
                $printer_id = intval($_POST['id']);
                $fullname = mysqli_real_escape_string($dbconnect, $_POST['fullname']);
                $phone = mysqli_real_escape_string($dbconnect, $_POST['phone']);
                $mail = mysqli_real_escape_string($dbconnect, $_POST['mail']);
                $count =  intval($_POST['count']);
                $query = "insert into mysitedb.clients (fullname, phone, mail) VALUES
                ('$fullname','$phone','$mail');";
                mysqli_query($dbconnect,"SET character_set_results = 'utf8',
                character_set_client = 'utf8', character_set_connection = 'utf8',
                character_set_database = 'utf8', character_set_server = 'utf8'");
                $ins = mysqli_query($dbconnect,$query);
                $client_id = mysqli_query($dbconnect,
                    'SELECT max(id) FROM mysitedb.clients;');
                $client_id = $client_id->fetch_assoc();
                $client_id = intval($client_id['max(id)']);

                $query = "select price from mysitedb.printers where id='$printer_id'";
                $SUMM = mysqli_query($dbconnect,$query);
                $SUMM = $SUMM->fetch_assoc();
                $SUMM = intval($SUMM['price']);
                $SUMM = $SUMM * $count;
                date_default_timezone_set('Etc/GMT-5');
                $date = date('Y/m/d H:m:s');
                $query = "insert into mysitedb.orders (printer_id, client_id, count, SUMM, date)
values ('$printer_id','$client_id','$count','$SUMM','$date');";

                if (mysqli_query($dbconnect,$query)){
                    echo '<p>Заказ успешно оформлен!</p>';
                }





            } else {
                if ($_GET) {
                    $maxid = mysqli_query($dbconnect,
                        'SELECT max(id) FROM mysitedb.printers;');
                    $maxid = $maxid->fetch_assoc();
                    $maxid = intval($maxid['max(id)']);
                    $id = intval($_GET['id']);
                    if ($id > 0 and $id <= $maxid) {
                        echo "  <form method='post' action='order.php'>
                <div class='fqw'>
                        <div>
                            <table>
                                <tr>

                                    <td><b>Номер товара</b></td><td><b><input type='hidden' name='id' value='$id'>$id</b></td>
                                </tr>
                                <tr>
                                    <td><b>Количество</b></td><td><b><input type='text' name='count' value='1'></b></td>
                                </tr>
                                <tr>
                                    <td><b>Ваше имя</b></td><td><b><input type='text' name='fullname' value='' maxlength='50'></b></td>
                                </tr>
                                <tr>
                                    <td><b>телефон</b></td><td><b><input type='text' name='phone' value=''></b></td>
                                </tr>
                                <tr>
                                    <td><b>email</b></td><td><input type='text' name='mail' value='' maxlength='50'></td>
                                </tr>
                                <tr><td><b><input type='submit' value='Заказать'></b></td></tr>



                            </table>
                        </div>

                </div>

            </form>";
                    } else {
                        echo '<h1>error</h1>';
                    }
                } else {
                    echo '<h1>error</h1>';
                }
            }
            ?>

        </div>

    </div>
</div>
</body>
</html>
