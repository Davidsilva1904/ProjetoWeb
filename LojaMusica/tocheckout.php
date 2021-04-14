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
    <title> Confirmação da sua compra </title>
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
            <div id="compras">
                <div  class="compras_lista">
                    <div>
                        <?php
                        tocheckout_validar();
                        ?>
                    </div><br><br>
                    <div>
                       <h3>A sua encomenda:</h3>
                    </div>
                    <table>
                       <?php lista_checkout();?>
                    </table>
                    
                </div>
                <div  class="compras_contas">
                   
                    <?php
                    if(@$_SESSION["log_id"]){
                        fechar_contas();
                    }
                    if(isset($_POST["confirmar_checkout"])){
                        comprado($_POST["venda_data"], $_POST["venda_carrinho"],$_POST["venda_valor"]);
                    }
                    ?>
                </div>
                <div class="limpa"></div>
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