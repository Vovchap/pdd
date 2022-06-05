<?php
require 'db.php'; 
$roleuser=$_SESSION['logged_user']->role;
$username=$_SESSION['logged_user']->login;
if (isset($_SESSION['logged_user'])){
    if($roleuser==TRUE)
    {
        header('Location: http://pdd/laters.php');
    }
}
else{
    header('Location: http://pdd/index.php');
}
$laters = R::findall("laters");
$fines = R::findall("violations");
$cars = R::findall("cars");
$data = $_POST;
if(isset($data["delete"]))
{
    $delete=R::load("laters",$data["id"]);
    R::trash($delete);
    $teklaters = R::findall("laters");
    foreach($teklaters as $tek)
    {
        if(($tek["number"] == $data["number"]) & ($tek["brand"] == $data["brand"]))
        {
            $sov = $sov+1;
        }
    }
    if($sov == 0)
    {
        foreach($cars as $car)
        {
            if(($car["number"] == $data["number"]) & ($car["brand"] == $data["brand"]))
            {
                $delete1=R::load("cars",$car["id"]);
                R::trash($delete1);
            }
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
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
    <div class='odin'>
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
                            <a href="laters.php">Создать извещение</a>
                            <?else:?>
                            <?endif?>
                            <a href="logout.php">Выйти</a>
                            <?php else :?>
                            <?php endif ;?>
                    </div>
                </div>
            </div>                   
    </header>
    <div class="cart">
                            <span class="cartT"> Извещения: </span>
                            <table class="table table-striped table-hover mt-2">
                                <thead class="table-dark">
                                <tr>
                                <th> Номер машины </th>
                                <th> Марка машины </th>
                                <th> Дата нарушения</th>
                                <th> Время нарушения</th>
                                <th> Тип нарушения</th>
                                <th> Штраф</th>
                                <th> Оплата</th>
                                </tr>                               
                                </thead>
                                <?php foreach ($laters as $value) { ?> 
                                <tr>
                                <?if($value["login"] == $username){?>
                                <td><?=$value['number']?></td>
                                <td><?=$value['brand']?></td>
                                <td><?=$value['date'] ?></td>
                                <td><?=$value['time']?></td>
                                <td><?=$value['type']?></td>
                                <?foreach ($fines as $fine){?>
                                <?if($fine["type"] == $value["type"]){?>
                                <td><?=$fine["fine"]?></td>
                                <?}?>
                                <?}?>
                                <td>
                                <form action="" method="POST"> 
                                <input type="hidden" name="number" value="<?=$value['number']?>">
                                <input type="hidden" name="brand" value="<?=$value['brand']?>">         
                                <input type="hidden" name="id" value="<?=$value['id']?>">                              
                                <button type="submit"  name="delete">Оплатить</button>
                                </form></td>
                                </tr>
                                </tr><?php } ?>
                                <?}?>
                                </tbody>                          
                            </table>
    </div>
</body>
</html>
