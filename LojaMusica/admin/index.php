<?php
session_start();
require_once 'functions_admin.php';
validar();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="estilos_admin.css">
    <title> Staff Loja da Margem Sul </title>
</head>
<body>
    <header>
        <div id="logotipo"><a href="index.php">Staff Loja de Música Margem Sul</a></div>
        <div id="account">
            <a href="../exit.php">Sair</a>
            </div>
            <div class="limpa"></div>
    </header>
    <nav>
        <ul>
            <li><a href="index.php?opt=1">Utilizadores</a></li>
            <li><a href="index.php?opt=2">Produtos</a></li>
            <li><a href="index.php?opt=3">Stocks</a></li>
            <li><a href="index.php?opt=4">Promoções</a></li>
            <li><a href="index.php?opt=5">Vendas</a></li>
        </ul>
    </nav>
    <main>
        <?php
        @$opt = $_REQUEST["opt"];
        switch($opt){
                case'1';
                    include 'adm_utilizadores.php';
                break;
                case'2';
                    include 'adm_produtos.php';
                break;
                case'3';
                    include 'adm_stocks.php';
                break;
                case'4';
                    include 'adm_promocoes.php';
                break;
                case'5';
                    include 'adm_vendas.php';
                break;
            default:
                include 'adm_home.php';
                break;
        }
        ?>

    </main>
    <footer>Admin 2020</footer>
</body>


</html>
