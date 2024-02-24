<?php 
    if(!isset($_COOKIE['login'])){
        header('Location: /register.php');
        exit();
    }

?>


<!DOCTYPE html>
<html lang="ru">
<head>
<?php 
$websiteTitle="Добавление статьи";
require "blocks/head.php";?>
</head>
<body>
    <?php 
    require "blocks/header.php";
    ?>

    <main>
        <h1>Добавление статьи</h1>
        <form><!--action="ajax/reg.php" method="post"-->
            <label for="title">Название статьи</label>
            <input type="text" name="title" id="title" placeholder="Введите больше 3 символов">
            
            <label for="anons">Анонс статьи</label>
            <textarea name="anons" id="anons"></textarea>

            <label for="full_text">Основной текст</label>
            <textarea name="full_text" id="full_text"></textarea>
            
            <div class="error-mess" id="error-block"></div>

            <button type="button" id="add_article">Добавить статью</button><!--type="button" не происходит перезагрузки странички-->
        </form>
    </main>

    <?php 
    require "blocks/aside.php";
    ?>

    <?php 
    require "blocks/footer.php";
    ?>
    <script>
        $('#add_article').click(function(){
            let title=$('#title').val();//переменная = $обращение к input полю username.val получение его данных
            let anons=$('#anons').val();
            let fullText=$('#full_text').val();
            

            $.ajax({    //$ образение к функции ajax {передача объекта}
                url:'ajax/add_article.php',//где будут обрабатываться данные
                type: 'POST',//Метод передачи данных
                cache:false,//не будет кэша
                data:{'title':title,'anons':anons,'full_text':fullText},
                //какие значения будут переданы
                dataType:'html',//что конкретно мы можем принять из url
                success:function(data)//функция которая сработает при успешном выполнении кода reg.php
                {
                    if(data==="Done"){
                        $('#add_article').text("Все готово");//меняем текст на кнопке 
                        $('#error-block').hide(); //показываем ошибку
                        $('#title').val("");
                        $('#anons').val("");
                        $('#full_text').val("");
                        header("Location:/index.php");
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