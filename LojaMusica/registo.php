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
    <title> Registo </title>
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
                <input type="email" name="email" placeholder="Email:" required>
                <input type="password" name="senha" placeholder="Password" required>
                <input type="password" name="senha_val" placeholder="Repita Password" required>
                <hr>
                <input type="text" name="nome" placeholder="Nome:" required>
                <input type="text" name="apelido" placeholder="Apelido:" required>
                <input type="text" name="morada" placeholder="Morada:">
                <input type="text" name="localidade" placeholder="Localidade">
                <input type="text" name="cp" placeholder="Código Postal:">
                <input type="tel" name="telefone" placeholder="Telefone:">
                <hr>
                <input type="submit" name="registar" value="Registar">
            </form>
            <p>Já tem conta? <a href="login.php">Faça Login</a></p>
            <?php
        //Se o form for submetido
        if(isset($_POST["registar"])){
            //chamar a função entrar e enviar 2 parametros
            if($_POST["senha"]!=$_POST["senha_val"]){
                echo '<span class="erro">As senhas têm de ser iguais</span>';
            } else{
                registo($_POST["email"],
                        $_POST["senha"],
                        $_POST["nome"],
                        $_POST["apelido"],
                        $_POST["morada"],
                        $_POST["localidade"],
                        $_POST["cp"],
                        $_POST["telefone"]);
                }
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
