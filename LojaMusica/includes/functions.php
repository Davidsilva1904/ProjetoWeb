<?php
    function destaques(){
        include 'connections/conn.php';
            $qtaprd = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS qta FROM produtos"));
            $produtos = mysqli_query($conn,"SELECT * FROM produtos WHERE prd_destaque = 1 AND prd_promo_id IS NOT NULL limit 0,5");
            while ($produto = mysqli_fetch_array($produtos)){
                echo '
            <div class ="destaque">
            <a href="ficha_prd.php?prd_id='.$produto["prd_id"].'">
               <img src="img/'.$produto["prd_foto"].'">
            </a>
                <div class="destaque_preco">';
                if($produto["prd_promo_id"] != '0'){
                    echo'<span style="text-decoration: line-through; color:red;">'.$produto["prd_preço"].'.00€</span><br>';
                    $val_promo = mysqli_fetch_array(mysqli_query($conn,"select promo_val from promos where promo_id = '$produto[prd_promo_id]'"));
                    $preco_promocional = $produto["prd_preço"]-($produto["prd_preço"]*$val_promo["promo_val"]/100);
                    echo $preco_promocional.'.€';
                    number_format($preco_promocional,2,'.',',').'€';
                }else{
                    echo number_format($produto["prd_preço"],2,'.',',').'€';
                }
                    echo'</div>
                     <div class="destaque_tit">'.$produto["prd_nome"].'</div>
                     <a href="add_to_cart.php?prd_id='.$produto["prd_id"].'&prd_qta=1"><button>+</button></a>
                     </div>
                     ';
            }
        
        include 'connections/deconn.php';

    }    

    function destaques1(){
        include 'connections/conn.php';
            $qtaprd = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS qta FROM produtos"));
            $produtos = mysqli_query($conn,"SELECT * FROM produtos WHERE prd_destaque = 1 AND prd_promo_id IS NULL limit 0,5");
            while ($produto = mysqli_fetch_array($produtos)){
                echo '
            <div class ="destaque">
            <a href="ficha_prd.php?prd_id='.$produto["prd_id"].'">
               <img src="img/'.$produto["prd_foto"].'">
            </a>
                <div class="destaque_preco">';
                if($produto["prd_promo_id"] = '0'){
                    echo'<span style="text-decoration: line-through; color:red;">'.$produto["prd_preço"].'.00€</span><br>';
                    $val_promo = mysqli_fetch_array(mysqli_query($conn,"select promo_val from promos where promo_id = '$produto[prd_promo_id]'"));
                    $preco_promocional = $produto["prd_preço"]-($produto["prd_preço"]*$val_promo["promo_val"]/100);
                    echo $preco_promocional.'.€';
                    number_format($preco_promocional,2,'.',',').'€';
                }else{
                    echo number_format($produto["prd_preço"],2,'.',',').'€';
                }
                    echo'</div>
                     <div class="destaque_tit">'.$produto["prd_nome"].'</div>
                     <a href="add_to_cart.php?prd_id='.$produto["prd_id"].'&prd_qta=1"><button>+</button></a>
                     </div>
                     ';
            }
        
        include 'connections/deconn.php';

    }    

    function entrar($email, $senha) {

    include 'connections/conn.php';
    //$senha = base64_encode($senha);


    @$users = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM logins WHERE log_email = '$email' AND log_senha = '$senha'"));

    if (!$users) {
        echo '<span class="erro">Utilizador ou senha inválidos. Tente novamente.</span>';
    } else {
        //Utilizador Existe
        //Iniciar Sessão
        //session_start();
        $_SESSION["log_id"]   = $users["log_id"];//criação de variavel de sessão e alocação de valor a mesma.
        $_SESSION["log_type"] = $users["log_type"];
        //Ver se ele ja tinha carrinhos antigos
        $precarro = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM carrinhos WHERE carrinhos_log_id = '$_SESSION[log_id]' AND carrinhos_status = '0'"));
        mysqli_query($conn, "UPDATE carrinhos SET carrinhos_log_id = '$_SESSION[log_id]' WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'");
        //existe carrinho pendurado deste user
        if ($precarro["carrinhos_log_id"] != '') {
            //ler o id do carrinho atual
            
            $atual = mysqli_fetch_array(mysqli_query($conn, "SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
            //atualizar os prds do antigo para o novo carrinho
            
            $prds_antigos = mysqli_query($conn, "SELECT * FROM carrinho_items WHERE items_carrinhos_id = '$precarro[carrinhos_id]'");
            while ($prd_antigo = mysqli_fetch_array($prds_antigos)) {
                $repetido = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM carrinho_items WHERE items_carrinhos_id = '$atual[carrinhos_id]' AND items_prd_id = '$prd_antigo[items_prd_id]'"));
                
                if ($repetido["items_prd_id"] != '') {
                    $nova_qta = $prd_antigo["items_prd_qta"]+$repetido["items_prd_qta"];
                    mysqli_query($conn, "UPDATE carrinho_items SET items_prd_qta = '$nova_qta' WHERE items_carrinhos_id = '$repetido[items_carrinhos_id]' AND items_prd_id = '$repetido[items_prd_id]'");
                    mysqli_query($conn, "DELETE FROM carrinho_items WHERE items_carrinhos_id = '$precarro[carrinhos_id]'");
                }

            }

            
            
            //mysqli_query($conn, "UPDATE carrinho_items SET items_carrinhos_id = '$atual[carrinhos_id]' WHERE items_carrinhos_id = '$precarro[carrinhos_id]'");
            //atribuir o carro novo a este user
            //apagar o carro antigo
            mysqli_query($conn, "DELETE FROM carrinhos WHERE carrinhos_id = '$precarro[carrinhos_id]'");
        }

        //mysqli_query($conn, "UPDATE carrinhos SET carrinhos_log_id = '$_SESSION[log_id]' WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'");
        switch ($users["log_type"]) {
            case '0'://Admin
                //enviar user para painel administrativo
                echo '<meta http-equiv="refresh" content="0;url=admin/index.php">';
                break;
            case '1'://Usert
                //Fica na home page e tem que ter acesso a sua conta
                echo '<meta http-equiv="refresh" content="0;url=index.php">';
                break;
        }
    }

    include 'connections/deconn.php';

}

    function registo($email,$senha,$nome,$apelido,$morada,$localidade,$cp,$telefone){
        include 'connections/conn.php';    
            $email      = mysqli_real_escape_string($conn, $email);
            $senha      = mysqli_real_escape_string($conn, $senha);
            $nome       = mysqli_real_escape_string($conn, $nome);
            $apelido    = mysqli_real_escape_string($conn, $apelido);
            $morada     = mysqli_real_escape_string($conn, $morada);
            $localidade = mysqli_real_escape_string($conn, $localidade);
            $cp         = mysqli_real_escape_string($conn, $cp);
            $telefone   = mysqli_real_escape_string($conn, $telefone);
        
            $senha = base64_encode($senha);
        
            //Evitar duplicados
            $existe = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM logins where log_email = '$email'"));
            if(@!$existe){
            //Insersão
            mysqli_query($conn,"INSERT INTO logins (log_email,log_senha,log_type) VALUES ('$email','$senha','1')");
            $login_id = mysqli_insert_id($conn); //retorna o ultimo id inserido
        
            mysqli_query($conn,"INSERT INTO dados (dados_nome, 
                                                   dados_apelido, 
                                                   dados_morada, 
                                                   dados_localidade, 
                                                   dados_cp, 
                                                   dados_telefone, 
                                                   login_id) 
                                VALUES ('$nome',
                                        '$apelido',
                                        '$morada',
                                        '$localidade',
                                        '$cp',
                                        '$telefone',
                                        '$login_id')");
                
                 //--- Disparar serviço de email de registo seria aqui------------------
                
                 echo '<meta http-equiv="refresh" content="0;url=index.php">';
                
            }else{
                echo '<span class="erro">Este email já se encontra registado.</span>';
                //recuperação de senha?
            }
        include 'connections/deconn.php'; 
    }


    function carrinhos() {
    include 'connections/conn.php';
     $bytes                = openssl_random_pseudo_bytes(32);
     $prehash              = bin2hex($bytes);
     $hoje                 = date("Y-m-d");
     $auto_cart = $prehash;
        if (!isset($_SESSION["carrinho_ref"])) {
        $_SESSION["carrinho_ref"] = $auto_cart;
        mysqli_query($conn, "INSERT INTO carrinhos (carrinhos_ref,carrinhos_status) VALUES ('$_SESSION[carrinho_ref]','0')");
        }
    include 'connections/deconn.php';
}

function cestocompras_qta(){
    include 'connections/conn.php';
    $cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
    $qta = mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(items_prd_qta)as qta FROM carrinho_items WHERE items_carrinhos_id = '$cart_id[carrinhos_id]'"));
    if($qta["qta"] != ''){
        echo "O seu cesto (".$qta["qta"].")"; 
    }else{
        echo 'O seu cesto (0)';
    }
   
    include 'connections/deconn.php';
}

function compras_lista(){
    include 'connections/conn.php';
    $cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
    $artigos_carro = mysqli_query($conn,"SELECT carrinho_items.*, produtos.* FROM carrinho_items join produtos on carrinho_items.items_prd_id = produtos.prd_id where carrinho_items.items_carrinhos_id = '$cart_id[carrinhos_id]'");
    while($artigo_carro = mysqli_fetch_array($artigos_carro)){
    echo'
    <form method="post">
        <tr>
            <td><img src="img/'.$artigo_carro["prd_foto"].'"></td>
            <td>'.$artigo_carro["prd_nome"].'</td>
            <td><input type="number" min="1" name="prd_qta" value="'.$artigo_carro["items_prd_qta"].'"></td>
            <td>
                <input type="hidden" name="prd_id" value="'.$artigo_carro["prd_id"].'">
                <input type="submit" name="qta_update" value="Atualizar">
                <input type="submit" name="qta_delete" value="Apagar">
            </td>
        </tr>
        </form>
    ';
    }
    include 'connections/deconn.php';
}

function compras_contas(){
    include 'connections/conn.php';
    echo'<table>';
    $cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
    $artigos_carro = mysqli_query($conn,"SELECT carrinho_items.*, produtos.* FROM carrinho_items join produtos on carrinho_items.items_prd_id = produtos.prd_id where carrinho_items.items_carrinhos_id = '$cart_id[carrinhos_id]'");
    $total_carro = 0;
    $desconto = 0;
    while($artigo_carro = mysqli_fetch_array($artigos_carro)){
        $val_promo = mysqli_fetch_array(mysqli_query($conn,"SELECT promo_val from promos where promo_id = '$artigo_carro[prd_promo_id]'"));//valor % da promo
        echo'<tr>
                <td>'.$artigo_carro["items_prd_qta"].' x '.$artigo_carro["prd_nome"];
                $val_artigo = $artigo_carro["items_prd_qta"]*$artigo_carro["prd_preço"];
            echo'</td><td>';
            echo number_format($val_artigo,2,'.',',').'€';
            $total_carro += $val_artigo;
        $desconto += $artigo_carro["items_prd_qta"]*($artigo_carro["prd_preço"]*$val_promo["promo_val"]/100);
        echo '</td>
                </tr>';
    }
    include 'connections/deconn.php';   
    echo '</table>';
    echo '<div class="totais_carro">';
    echo 'Total: '.number_format($total_carro,2,'.',',').'€';
    if($desconto > 0){
    echo '<br>Desconto Imediato:'.number_format($desconto,2,'.',',').'€';
    }
    echo '<br>A Pagar:';
    $pagamento = $total_carro - $desconto;
    echo number_format($pagamento,2,'.',',').'€';
    echo '<br><a href="tocheckout.php"><button>Comprar</button></a>';
    echo '</div>';
}

function qta_update($prd_qta,$prd_id){
include 'connections/conn.php';
$cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
mysqli_query($conn,"UPDATE carrinho_items set items_prd_qta = '$prd_qta' where items_prd_id = '$prd_id' AND items_carrinhos_id = '$cart_id[carrinhos_id]'");
include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=cestocompras.php">';
}
function qta_delete($prd_id){
include 'connections/conn.php';
$cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
mysqli_query($conn,"DELETE FROM carrinho_items where items_prd_id = '$prd_id' AND items_carrinhos_id = '$cart_id[carrinhos_id]'");
include 'connections/deconn.php'; 
     echo '<meta http-equiv="refresh" content="0;url=cestocompras.php">';
}

function tocheckout_validar(){
    include 'connections/conn.php';
    if(!@$_SESSION["log_id"]) {
        echo 'Faça Login <a href="login.php">aqui</a>';               
    }else{
        $dados = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM dados WHERE login_id = '$_SESSION[log_id]'"));
        $hoje = date("Y-m-d");
        echo '<h3>Dados de Envio:</h3>';
        echo '<table>';
        echo '<tr>
                <td>'.$dados["dados_nome"].' '.$dados["dados_apelido"].'</td>
                <td>'.$dados["dados_morada"].' <br> '.$dados["dados_cp"].' '.$dados["dados_localidade"].' <br> Telefone: '.$dados["dados_telefone"].'</td>
                <td>Data Pedido: '.$hoje.'</td>
              </tr>
              <tr>
              <td colspan ="3">Chave Encomenda: '.$_SESSION["carrinho_ref"].'</td>
              </tr>';
        echo '</table>';
    }
    include 'connections/deconn.php';
}

function lista_checkout(){
    include 'connections/conn.php';
    $cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
    $artigos_carro = mysqli_query($conn,"SELECT carrinho_items.*, produtos.* FROM carrinho_items join produtos on carrinho_items.items_prd_id = produtos.prd_id where carrinho_items.items_carrinhos_id = '$cart_id[carrinhos_id]'");
    while($artigo_carro = mysqli_fetch_array($artigos_carro)){
    echo'
        <tr>
            <td><img src="img/'.$artigo_carro["prd_foto"].'"></td>
            <td>'.$artigo_carro["prd_nome"].'</td>
            <td>Qta:'.$artigo_carro["items_prd_qta"].'</td>
            <td>
            </td>
        </tr>
    ';
    }
    include 'connections/deconn.php';
}

function fechar_contas(){
    include 'connections/conn.php';
    echo'<table>';
    $cart_id = mysqli_fetch_array(mysqli_query($conn,"SELECT carrinhos_id FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
    $artigos_carro = mysqli_query($conn,"SELECT carrinho_items.*, produtos.* FROM carrinho_items join produtos on carrinho_items.items_prd_id = produtos.prd_id where carrinho_items.items_carrinhos_id = '$cart_id[carrinhos_id]'");
    $total_carro = 0;
    $desconto = 0;
    while($artigo_carro = mysqli_fetch_array($artigos_carro)){
        $val_promo = mysqli_fetch_array(mysqli_query($conn,"SELECT promo_val from promos where promo_id = '$artigo_carro[prd_promo_id]'"));//valor % da promo
        echo'<tr>
                <td>'.$artigo_carro["items_prd_qta"].' x '.$artigo_carro["prd_nome"];
                $val_artigo = $artigo_carro["items_prd_qta"]*$artigo_carro["prd_preço"];
            echo'</td><td>';
            echo number_format($val_artigo,2,'.',',').'€';
            $total_carro += $val_artigo;
        $desconto += $artigo_carro["items_prd_qta"]*($artigo_carro["prd_preço"]*$val_promo["promo_val"]/100);
        echo '</td>
                </tr>';
    }
    include 'connections/deconn.php';   
    echo '</table>';
    echo '<div class="totais_carro">';
    echo 'Total: '.number_format($total_carro,2,'.',',').'€';
    if($desconto > 0){
    echo '<br>Desconto Imediato:'.number_format($desconto,2,'.',',').'€';
    }
    echo '<br>A Pagar:';
    $pagamento = $total_carro - $desconto;
    echo number_format($pagamento,2,'.',',').'€';
    $hoje=date("Y-m-d");
    echo '<br>
    <form method="post">
    <input type="hidden" name="venda_data" value="'.$hoje.'">
    <input type="hidden" name="venda_carrinho" value="'.$cart_id["carrinhos_id"].'">
    <input type="hidden" name="venda_valor" value="'.$pagamento.'">
    <button type="submit" name="confirmar_checkout">Confirmar</button>
    </form>';
    echo '</div>';
}

function comprado($venda_data, $venda_carrinho, $venda_valor) {
    include 'connections/conn.php';
    mysqli_query($conn, "INSERT INTO venda_carrinho (venda_data, venda_carrinho, venda_valor) VALUES ('$venda_data','$venda_carrinho','$venda_valor')");
    mysqli_query($conn, "UPDATE carrinhos SET carrinhos_status = '1' WHERE carrinhos_id = '$venda_carrinho'");
    //Ver os artigos que foram comprados
    $compras = mysqli_query($conn, "SELECT * FROM carrinho_items WHERE items_carrinhos_id = '$venda_carrinho'");
    while ($comprado = mysqli_fetch_array($compras)) {
        //para cada artigo ver a qta comprada
        //ir a stocks onde prd = prdcomprado
        $stocks = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM stocks WHERE stock_prd_id = '$comprado[items_prd_id]'"));
        //reduzir o stock para o novo stock
        $novo_stock = $stocks["stock_qta"]-$comprado["items_prd_qta"];
        mysqli_query($conn, "UPDATE stocks SET stock_qta = '$novo_stock' WHERE stock_prd_id = '$comprado[items_prd_id]'");
    }

    unset($_SESSION['carrinho_ref']);
    $bytes     = openssl_random_pseudo_bytes(32);
    $prehash   = bin2hex($bytes);
    $hoje      = date("Y-m-d");
    $auto_cart = $prehash;
    if (!isset($_SESSION["carrinho_ref"])) {
        $_SESSION["carrinho_ref"] = $auto_cart;
        mysqli_query($conn, "INSERT INTO carrinhos (carrinhos_ref, carrinhos_status, carrinhos_log_id) VALUES ('$_SESSION[carrinho_ref]','0', '$_SESSION[log_id]')");
    }
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=aminhaconta.php">';
}

function consulta_historico() {
    include 'connections/conn.php';
    $historico = mysqli_query($conn, "SELECT carrinhos.*, venda_carrinho.* FROM carrinhos JOIN venda_carrinho ON carrinhos.carrinhos_id = venda_carrinho.venda_carrinho WHERE carrinhos.carrinhos_status = 1 AND carrinhos.carrinhos_log_id = '$_SESSION[log_id]'
        ORDER BY venda_carrinho.venda_data ASC");
    while ($historia = mysqli_fetch_array($historico)) {
        echo '
            <table>
            <tr>
            <td>Data: '.$historia["venda_data"].'</td>
            <td>';
        $historico_produtos = mysqli_query($conn, "SELECT carrinho_items.*, produtos.* FROM carrinho_items JOIN produtos ON carrinho_items.items_prd_id = produtos.prd_id WHERE items_carrinhos_id = '$historia[carrinhos_id]'");
        while ($historia_produtos = mysqli_fetch_array($historico_produtos)) {
            echo '<div>'.$historia_produtos["items_prd_qta"].' x '.$historia_produtos["prd_nome"].' </div>';
        }
        echo '</td>
            <td>Ref: '.$historia["carrinhos_id"].'</td>
            <td>Total: '.number_format($historia["venda_valor"], 2, ',', '.').'€</td>
        </tr></table><hr>';
    }
    include 'connections/deconn.php';
}


function gestao_conta(){
    include 'connections/conn.php';
    $dados_conta = mysqli_fetch_array(mysqli_query($conn,"SELECT logins.log_email,dados.* FROM logins join dados on logins.log_id = dados.login_id where logins.log_id = '$_SESSION[log_id]'"));
    echo'
        <form method="post">
            <h3>A minha conta:</h3>
            <input type="text" name="dados_nome" value="'.$dados_conta["dados_nome"].'">
            <input type="text" name="dados_apelido" value="'.$dados_conta["dados_apelido"].'">
            <input type="text" name="dados_morada" value="'.$dados_conta["dados_morada"].'">
            <input type="text" name="dados_cp" value="'.$dados_conta["dados_cp"].'">
            <input type="text" name="dados_telefone" value="'.$dados_conta["dados_telefone"].'">
            <input type="email" name="log_email" value="'.$dados_conta["log_email"].'">
            <input type="submit" name="update_account" value="Atualizar">
        </form>
        <a href="exit.php">
            <button>Sair</button>
        </a>
    ';
    include 'connections/deconn.php';
}

function update_account($dados_nome, $dados_apelido, $dados_morada,$dados_localidade ,$dados_cp, $dados_telefone, $log_email){
    include 'connections/conn.php';
    mysqli_query($conn, "UPDATE dados SET dados_nome = '$dados_nome', dados_apelido = '$dados_apelido', dados_morada = '$dados_morada', dados_localidade = '$dados_localidade', dados_cp = '$dados_cp', dados_telefone = '$dados_telefone' WHERE login_id = '$_SESSION[log_id]'");
    mysqli_query($conn, "UPDATE logins set log_email = '$log_email' where log_id = '$_SESSION[log_id]'");
    include 'connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=aminhaconta.php">';
}


//include 'connections/conn.php';
//include 'connections/deconn.php';

?>