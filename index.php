<?php
    require 'db.php'; 
    if (isset($_SESSION['logged_user'])){
        header('Location: http://pdd/main.php');
    }
else{}
    $data=$_POST;
    if(isset($data['Vhod'])){
        $errors= array();      
        $user=R::findOne('users', 'login=?',array($data['login']));
        if( $user ){
            if(password_verify($data['password'], $user->password)){
                $_SESSION['logged_user']=$user;
                header('Location: main.php');
            }else{
                $errors[]='Неверно введен пароль!';
            }
        }else{
            $errors[]='Пользователь не найден';
        }
        if(!empty($errors)){
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
        <script>
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
                            <?php else :?>
                            <?php endif ;?>
                    </div>
                </div>
            </div>                   
        </header>

        <div class="request">            
            <div class="textss">Авторизация</div>
            <form class="form-signin" method="POST">
                <p class="texts">Введите логин</br>
                    <input type="text"  class="input1" name="login" value="<?php echo @$data['login']; ?>">
                </p>
                <p class="texts">Введите пароль<br>
                    <input type="password" name="password"  class="input2" value="<?php echo @$data['password']; ?>">
                </p>
                <div class="sub"><input type="submit" name="Vhod" class="buttonius" value="Войти"></div>     
        </form>
            <?php if(isset($fsmsg)){?><div class="alert alert-danger" role="alert"> <?php echo $fsmsg; ?> </div><?php }?>
        </div>
    </div>    
    </div>
</div>
    </body>
</html>