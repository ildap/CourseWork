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
        <p class="brend"><a href="?">Print Store</a></p>

        <p class="mEl"><a href="edit.php">Добавить товар</a></p>
    </div>
    <p class="mEl2"><a href="contact.html">Обратная связь</a></p>
    <p class="mEl2"><a href="conctacts.html">Контактные данные</a></p>
</div>
<div class="content2">
    <div class="left">
        <?php
        $dbhost = "192.168.1.106:3300";
        $dbusername = "root";
        $dbpass = "8mxp";
        $dbconnect = mysqli_connect($dbhost, $dbusername, $dbpass);
        if ($_GET) {
            $page = intval($_GET['page']);
            if ($page <= 0) {
                $page = 1;
            }
            $offset = ($page * 9) - 9;
        } else {
            $page = 1;
            $offset = 0;

        }

        mysqli_query($dbconnect, "SET character_set_results='utf8';");
        $select_printers = mysqli_query($dbconnect,
            "SELECT id,type,model,price FROM mysitedb.printers order by -id LIMIT 9 offset $offset;");
        $td = 0;
        $tr = 0;
        echo "<table>
                <tr>";
        while ($printer = mysqli_fetch_array($select_printers)) {
            $td += 1;

            echo "<td>
                    <div class='printer menu1'>
                        <a href='printer.php?id=$printer[id]'>
                            <p class='img'><img src='static/$printer[id].jpg'</p>
                            <p class='name'>$printer[type] принтер $printer[model]</p>
                            <p class='name'>Цена: $printer[price]</p>
                        </a>
                    </div>
                  </td>";

            if ($td > 2) {
                $td = 0;
                $tr += 1;
                echo '</tr>
                      <tr>';
            }


        }
        echo "    </tr>
              </table>
              <div>";
        $npage = $page + 1;
        if ($page > 1) {
            $ppage = $page - 1;
            echo "<p class='mEl name'><a href='?page=$ppage'>$ppage</a></p>";
        }
        echo "<p class='mEl name'><b>$page</b></p>";
        echo "<p class='mEl name'><a href='?page=$npage'>$npage</a></p>
            </div>";
        ?>
    </div>
</div>
</body>
</html>