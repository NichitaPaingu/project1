<!DOCTYPE html>
<html lang="ru">
    <?php
    
    ?>
<head>
<?php 
$websiteTitle="Регистрация";
require "blocks/head.php";?>
</head>
<body>
    <?php 
    require "blocks/header.php";
    ?>

    <main>
        <h1>Регистрация</h1>
        <form><!--action="ajax/reg.php" method="post"-->
            <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" placeholder="Введите больше 3 символов">
            
            <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Введите больше 6 символов">
            
            <label for="login">Логин</label>
                <input type="text" name="login" id="login" placeholder="Введите больше 8 символов">
            
            <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Введите больше 8 символов">
            
                <div class="error-mess" id="error-block"></div>

            <button type="button" id="reg_user">Зарегестрироваться</button><!--type="button" не происходит перезагрузки странички-->
        </form>
    </main>

    <?php 
    require "blocks/aside.php";
    ?>

    <?php 
    require "blocks/footer.php";
    ?>
    <script>
        $('#reg_user').click(function(){
            let name=$('#username').val();//переменная = $обращение к input полю username.val получение его данных
            let email=$('#email').val();
            let login=$('#login').val();
            let password=$('#password').val();

            $.ajax({    //$ образение к функции ajax {передача объекта}
                url:'ajax/reg.php',//где будут обрабатываться данные
                type: 'POST',//Метод передачи данных
                cache:false,//не будет кэша
                data:{'username':name,'email':email,'login':login,'password':password},
                //какие значения будут переданы
                dataType:'html',//что конкретно мы можем принять из url
                success:function(data)//функция которая сработает при успешном выполнении кода reg.php
                {
                    if(data==="Done"){
                        $('#reg_user').text("Все готово");//меняем текст на кнопке 
                        $('#error-block').hide(); //показываем ошибку
                    }
                    else{
                        $('#error-block').show();//сделаем так чтобы показала блок
                        $('#error-block').text(data); //показываем ошибку
                        
                    }
                }
            })
        });
        //$ специальный символ в jquery 
        //Благодаря ему мы можем получить доступ к различным элементам 
    </script>

</body>
</html>