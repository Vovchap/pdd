<?php
require 'db.php'; 
$roleuser=$_SESSION['logged_user']->role;
if ($roleuser == true){}

else{
    header('Location: http://pdd/index.php');
}
$data = $_POST;
$userid=$_SESSION['logged_user']->id;
$username=$_SESSION['logged_user']->login;
$roleuser=$_SESSION['logged_user']->role;
$cars = R::findall("cars");
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
                            <span class="cartT"> Машины-штрафники: </span>
                            <table class="table table-striped table-hover mt-2">
                                <thead class="table-dark">
                                <tr>
                                <th> Номер машины </th>
                                <th> Марка машины </th>
                                <th> Владелец </th>
                                </tr>                               
                                </thead>
                                <?foreach($cars as $car){?>
                                    <tr>
                                    <td><?=$car["number"]?></td>
                                    <td><?=$car["brand"]?></td>
                                    <td><?=$car["login"]?></td>
                                    </tr>
                                <?}?>
                            </table>
        </div>
    </div>
</body>
</html>