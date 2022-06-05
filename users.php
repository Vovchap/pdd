<?php 
    require 'db.php'; 
    $roleuser=$_SESSION['logged_user']->role;
    if ($roleuser == true){}
    else{
        header('Location: http://pdd/index.php');
    }
    $data = $_POST;
    $errors = array(); 
    if(isset($data['registr'])){
        if(trim($data['login'])==''){
            $errors[]= 'Введите имя пользователя';
        }
        if($data['password']==''){
            $errors[]= 'Введите пароль';
        }
        if(R::count('users', "login=?",array($data['login']))>0)
        {
            $errors[]= "Пользователь с таким именем уже существует";
        }
        if(empty($errors)){
            $user=R::dispense('users');
            $user->login = $data['login'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            $smsg="Пользователь успешно создан";
        }else{
            $fsmsg=array_shift($errors);
        }
    }
?>
<html>
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
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
        <div class="black">
        <div class="request1"></div>
        <div class="request">            
            <div class="textss">Создание пользователя</div>
            <form class="form-signin" method="POST">
                <p class="texts px-md-4">Имя пользователя</br>
                    <input type="text"  class="form-control input1" name="login" value="<?php echo @$data['login']; ?>">
                </p>
                <p class="texts px-md-4"> Пароль<br>
                    <input type="Password" name="password"  class="form-control input2" value="<?php echo @$data['password']; ?>">
                </p>
                <div class="sub px-md-4"><input type="submit" name="registr" class="button1 " value="Создать"></div>     
        </form>
            <?php 
                if(isset($smsg)){
            ?>
            <div class="alert alert-success" role="alert"> 
            <?php 
                echo $smsg; 
            ?> 
            </div>
            <?php 
                }
            ?>
            <?php if(isset($fsmsg)){?><div class="alert alert-danger" role="alert"> <?php echo $fsmsg; ?> </div><?php }?>
        </div>
        <div class="request2"></div>
    </div>    
    </div>
    </div>
</div>
    </body>
</html>