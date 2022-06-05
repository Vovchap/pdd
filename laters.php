<?php

require 'db.php';
$roleuser=$_SESSION['logged_user']->role;
if ($roleuser == true){}
else{
    header('Location: http://pdd/index.php');
}
$data = $_POST;
$userid=$_SESSION['logged_user']->id;
$roleuser=$_SESSION['logged_user']->role;
$violations = R::FindAll("violations");
$cars = R::FindAll("cars");
if(isset($data["create"]))
{
    $izv = R::dispense("laters");
    $izv->number = $data["number"];
    $izv->brand = $data["brand"];
    $izv->login = $data["login"];
    $izv->type = $data["typev"];
    $izv->date = $data["date"];
    $izv->time = $data["time"];
    R::store($izv);
    $new = "1";
    if($cars)
    {
        foreach($cars as $car)
        {
            if(($car["number"] == $data["number"]) & ($car["brand"] == $data["brand"]))
            {
                    $new = "0";
            }
        }
        if($new == "1")
            {
                $carrs = R::dispense("cars");
                $carrs->number=$data["number"];
                $carrs->brand=$data["brand"];
                $carrs->login=$data["login"];
                R::store($carrs);
            }
    }
    else
    {
        $carrs = R::dispense("cars");
        $carrs->number=$data["number"];
        $carrs->brand=$data["brand"];
        $carrs->login=$data["login"];
        R::store($carrs);
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <script>
            function OpenMenu() {
                document.getElementById("myDropdown").classList.toggle("show");
            }
            window.onclick = function(event) {
              if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            }
        </script>
        <link rel="stylesheet" href="CSS.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
<body>
    <div class='tri'>
        <header class='header'>
            <div class="headerPlan">
                <div class="dropdown">
                    <button onclick="OpenMenu()" class="dropbtn"> 
                        <div class="Menu">
                        <div class="MenuOpen1"></div>
                        <div class="MenuOpen1"></div>
                        <div class="MenuOpen1"></div>
                        </div>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        <?php if(isset($_SESSION['logged_user'])): ?>
                            <? if($roleuser == true):?>
                            <a href="cars.php">Список машин</a>
                            <a href="users.php">Создать пользователя</a>
                            <?else:?>
                            <?endif?>
                            <a href="logout.php">Выйти</a>
                            <?php else :?>
                            <?php endif ;?>
                    </div>
                </div>
            </div>          
        </header>
                            <div class="cartt">
                            <span class="cartTT"> Заполнение извещения: </span>
                            <div class="cartss">
                                <form action="" method="POST">
                                <div>
                                    <br>
                                    <p>Укажите номер машины</p>
                                    <input type="text" name = "number" value="" required>
                                </div>
                                <div>
                                    <br>
                                    <p>Укажите марку машины</p>
                                    <input type="text" name = "brand" value="" required>
                                </div>
                                <div>
                                    <br>
                                    <p>Укажите владельца</p>
                                    <input type="text" name = "login" value="" required>
                                </div>
                                <br>
                                <p>Укажите тип нарушения</p>
                                 <select name="typev">
                                  <?foreach($violations as $viola){?>
                                  <option value="<?=$viola["type"]?>" required><?=$viola["type"]?></option>
                                  <?}?>
                                </select>
                                <div>
                                <br>
                                    <p>Укажите дату нарушения</p>
                                    <input type="date" name="date" required>
                                </div>
                                <div>
                                <br>
                                    <p>Укажите время нарушения</p>
                                    <input type="time" name="time" required>
                                </div>
                                <br>
                                <input type="submit" class="button2" name="create" value="создать">
                                </form>
                </table>
                            </div>
        </div>
    </div>
</body>
</html>