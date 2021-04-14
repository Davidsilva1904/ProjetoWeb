<?php
session_start();
require 'includes/functions.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login </title>
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" type="text/css" href="css/estilosvinyl.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- script para esconder os elementos mobile-->
    <script> 
        $(document).ready(function() {
            //      $('.bt_header_menu').hide();
            //        $('.bt_header_mob').hide();
        });
    </script>
</head>

<body>

    <!--Cabçallho-->
    <?php //arranca php e faz a inclusao do codigo do ficheiro indicado
        include 'includes/header.php';
?>
    <!--Fim Cabçallho-->

    <!--Nav-->
    <?php //arranca php e faz a inclusao do codigo do ficheiro indicado
        include 'includes/nav.php';
?>
    <!--Fim Nav -->

    <!--Main-->
        <main> 
        <div class="login">
        <form method="post">
            <input type="email" name="email" placeholder="Email:">
            <input type="password" name="senha" placeholder="Password">
            <input type="submit" name="entrar" value="Login">
        </form>
        <p>Ainda não tem conta? <a href="registo.php">Registe-se</a></p>
        <?php
        //Se o form for submetido
        if(isset($_POST["entrar"])){
            //chamar a função entrar e enviar 2 parametros
            entrar($_POST["email"],$_POST["senha"]);
        }
        ?>
        </div>
        </main>

    <!--Fim Main-->

    <!--Footer-->
    <?php //arranca php e faz a inclusao do codigo do ficheiro indicado
        include 'includes/footer.php';
        ?>
    <!--Fim Footer-->
</body>

</html>
