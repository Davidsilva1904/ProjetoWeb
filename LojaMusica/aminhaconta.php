<?php 
session_start();
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Música Margem Sul</title>
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
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
                  <?php consulta_historico();
                  ?>
                </div>
                <div class="compras_contas">
                    <?php gestao_conta();
                    if(isset($_POST["update_account"])){
                        update_account($_POST["dados_nome"], $_POST["dados_apelido"], $_POST["dados_morada"], $_POST["dados_localidade"], $_POST["dados_cp"], $_POST["dados_telefone"], $_POST["log_email"]);
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