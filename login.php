<!DOCTYPE html>
<html lang="ru">
<head>
    <?php 
        $websiteTitle="Авторизация";
        require "blocks/head.php";
    ?>
</head>
<body>
    <?php 
    require "blocks/header.php";
    ?>

    <main>
        <?php if(!isset($_COOKIE['login'])): ?>
        <h1>Авторизация</h1>
        <form><!--action="ajax/reg.php" method="post"-->
            <label for="login">Логин</label>
            <input type="text" name="login" id="login" placeholder="Введите больше 8 символов">
            
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" placeholder="Введите больше 8 символов">
            
            <div class="error-mess" id="error-block"></div>

            <button type="button" id="login_user">Войти</button><!--type="button" не происходит перезагрузки странички-->
        </form>
        <?php else:?>
            <h1><?=$_COOKIE['login']?></h1>
            <form>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif;?>
    </main>

    <?php 
    require "blocks/aside.php";
    ?>

    <?php 
    require "blocks/footer.php";
    ?>
    <script>
        $('#login_user').click(function(){
            let login=$('#login').val();
            let password=$('#password').val();

            $.ajax({    //$ образение к функции ajax {передача объекта}
                url:'ajax/log_in.php',//где будут обрабатываться данные
                type: 'POST',//Метод передачи данных
                cache:false,//не будет кэша
                data:{'login':login,'password':password},
                //какие значения будут переданы
                dataType:'html',//что конкретно мы можем принять из url
                success:function(data)//функция которая сработает при успешном выполнении кода reg.php
                {
                    if(data==="Done"){
                        $('#login_user').text("Все готово");//меняем текст на кнопке 
                        $('#error-block').hide(); //показываем ошибку
                        document.location.reload(true);//перезагрузка страницы
                    }
                    else{
                        $('#error-block').show();//сделаем так чтобы показала блок
                        $('#error-block').text(data); //показываем ошибку
                        
                    }
                }
            });
        });

        $('#exit_user').click(function(){
            $.ajax({
                url:'ajax/exit.php',
                type: 'POST',
                cache:false,
                data:{},
                dataType:'html',
                success: function(data){
                    document.location.reload(true);
                }
            });
        });
    </script>
</body>
</html>