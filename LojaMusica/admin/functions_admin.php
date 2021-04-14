<?php


function validar(){
if(!(isset($_SESSION["log_type"]))){
echo'<meta http-equiv="refresh" content="0;url=../index.php">';
    }else{
if($_SESSION["log_type"] != '0'){
echo'<meta http-equiv="refresh" content="0;url=../index.php">';
        }
    }
 
}




function top_info_titulo($opt){
     switch($opt){
                case'1';
                    echo 'Gestão de Utilizadores';
                    break;
                case'2';
                    echo 'Gestão de Produtos';
                break;
                case'3';
                    echo 'Gestão de Stocks';
                break;
                case'4';
                    echo 'Gestão de Promoções';
                break;
                case'5';
                    echo 'Análise de Vendas';
                break;
            default:
                echo 'Administrativo Loja de Musica Margem Sul';
                break;
     }
}

function lista_utilizadores(){
    include '../connections/conn.php';
    $users = mysqli_query($conn,"SELECT logins.log_id, logins.log_email, dados.dados_nome, dados.dados_apelido,
    dados.dados_morada, dados.dados_localidade, dados.dados_cp, dados.dados_telefone, dados.dados_id from logins JOIN dados ON logins.log_id = dados.login_id where logins.log_type= '1'");
    while($user = mysqli_fetch_array($users)){
        echo '
        <tr>
            <td>'.$user["log_id"].'</td>
            <td>'.$user["log_email"].'</td>
            <td>'.$user["dados_nome"].' '.$user["dados_apelido"].'</td>
            <td>'.$user["dados_morada"].' <br> '.$user["dados_cp"].' '.$user["dados_localidade"].'</td>
            <td>'.$user["dados_telefone"].'</td>
            <td>
            <a href="?opt=1&edit='.$user["dados_id"].'"><button class="edit_bt">Editar</button></a>
            <a href="?opt=1&del='.$user["dados_id"].'"><button class="del_bt">Apagar</button></a>
            </td>
        </tr>';
    }
    include '../connections/deconn.php';
}
function edicao_utilizador($edit){
    include '../connections/conn.php';
    $editar = mysqli_fetch_array(mysqli_query($conn,"SELECT dados.*, logins.* FROM dados JOIN logins ON dados.login_id = logins.log_id WHERE dados.dados_id = '$edit'"));
    echo '
    <tr>
            <td>'.$editar["log_id"].'</td>
            <td><input type="email" value="'.$editar["log_email"].'" name="log_email"></td>
            <td><input type="text" value="'.$editar["dados_nome"].'" name="dados_nome">
                <input type="text" value="'.$editar["dados_apelido"].'" name="dados_apelido">
            </td>
            <td><input type="text" value="'.$editar["dados_morada"].'" name="dados_morada">
                <input type="text" value="'.$editar["dados_cp"].'" name="dados_cp">
                <input type="text" value="'.$editar["dados_localidade"].'" name="dados_localidade">
            </td>
            <td><input type="text" value="'.$editar["dados_telefone"].'" name="dados_telefone"></td>
            <td><input type="hidden" value="'.$editar["dados_id"].'" name="dados_id">
            <input type="hidden" value="'.$editar["log_id"].'" name="log_id">
            <input type ="submit" name="atualizar_utilizador" class ="edit_bt" value="Atualizar"</td>
        </tr>';
        include '../connections/deconn.php';
}

function atualizar_utilizador($log_email, $dados_nome, $dados_apelido, $dados_morada, $dados_cp, $dados_localidade, $dados_telefone, $dados_id, $log_id){
    include '../connections/conn.php';
    mysqli_query($conn,"UPDATE logins SET log_email = '$log_email' WHERE log_id = '$log_id'");
    mysqli_query($conn,"UPDATE dados SET dados_nome = '$dados_nome', dados_apelido = '$dados_apelido', dados_morada = '$dados_morada', dados_cp = '$dados_cp', dados_localidade = '$dados_localidade', dados_telefone = '$dados_telefone' WHERE dados_id = '$dados_id'");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=1&edit='.$dados_id.'">';

}

function novo_utilizador($log_email, $dados_nome, $dados_apelido, $dados_morada, $dados_cp, $dados_localidade, $dados_telefone){
    include '../connections/conn.php';
    $senha = base64_encode('123');
    $existe = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM logins where log_email = '$log_email'"));
            if(!$existe){
    mysqli_query($conn,"INSERT INTO logins (log_email,log_senha,log_type) VALUES ('$log_email','$senha','1')");
    $login_id = mysqli_insert_id($conn);
    mysqli_query($conn,"INSERT INTO dados (dados_nome, dados_apelido, dados_morada, dados_localidade, dados_cp, dados_telefone, login_id) 
                                VALUES ('$dados_nome', '$dados_apelido', '$dados_morada', '$dados_localidade', '$dados_cp', '$dados_telefone', '$login_id')");
}
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=1">';
}

function delete_utilizador ($del){
    include '../connections/conn.php';

 $delete = mysqli_fetch_array(mysqli_query($conn,"SELECT dados.*, logins.* FROM dados JOIN logins ON dados.login_id = logins.log_id WHERE dados.dados_id = '$del'"));
    mysqli_query($conn, "DELETE FROM dados WHERE dados_id = '$del'");
    mysqli_query($conn, "DELETE FROM logins WHERE log_id = '$delete[login_id]'");

 include '../connections/deconn.php';
 echo '<meta http-equiv="refresh" content="0;url=index.php?opt=1">';
}

function lista_prds(){
    include '../connections/conn.php';
    $prds = mysqli_query($conn, "SELECT * FROM produtos");
    while ($prd = mysqli_fetch_array($prds)) {

        echo '
         <tr>
            <td>'.$prd["prd_id"].'</td>
            <td><img src="../img/'.$prd["prd_foto"].'"></td>
            <td>'.$prd["prd_nome"].'</td>
            <td>'.$prd["prd_ref"].'</td>
            <td>'.$prd["prd_preço"].'</td>
            <td>'.$prd["prd_descricao"].'</td>
            <td>
            <a href="?opt=2&edit='.$prd["prd_id"].'"><button class="edit_bt">Editar</button></a>
            <a href="?opt=2&del='.$prd["prd_id"].'"><button class="del_bt">Apagar</button></a>
            </td>
        </tr>';
    }
    include '../connections/deconn.php';

}
function new_prd($prd_nome, $prd_ref, $prd_preço, $prd_descricao, $foto){
 


    include '../connections/conn.php';
    $result = mysqli_query($conn, "INSERT INTO produtos (prd_nome, prd_preço, prd_descricao, prd_foto, prd_destaque, prd_ref) 
                        VALUES('$prd_nome','$prd_preço', '$prd_descricao', '$foto', '0', '$prd_ref')");



    $prd_id = mysqli_insert_id($conn);
    mysqli_query($conn,"INSERT INTO stocks (stock_prd_id, stock_qta) VALUES ('$prd_id','0')");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=2">';


}
function apagar_prd ($del){
    include '../connections/conn.php';

 $delete = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM produtos WHERE prd_id = '$del'"));
    unlink('../img'.$delete["prd_foto"]);
    mysqli_query($conn, "DELETE FROM produtos WHERE prd_id = '$del'");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=2">';
}

function edicao_prd($edit){
    include '../connections/conn.php';

    $editar = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM produtos WHERE prd_id = '$edit'"));

    echo '<tr>';
    echo '<td>';
    echo '<img src="../img/prds/'.$editar["prd_foto"].'">';
    echo '<input type ="file" name="prd_foto">';
    echo '</td>';
    echo '<td><input type = "text" name="prd_nome" value="'.$editar["prd_nome"].'"</td>';
    echo '<td><input type = "text" name="prd_ref" value="'.$editar["prd_ref"].'"</td>';
    echo '<td><input type = "number" name="prd_preço" value="'.$editar["prd_preço"].'"</td>';
    echo '<td><textarea name="prd_descricao">'.$editar["prd_descricao"].'</textarea></td>';
    echo '<td><select name="prd_promo_id">';
    $promos = mysqli_query($conn,"select * from promos");
    echo '<option value="0" selected>Sem Promoção</option>';  
        while($promo = mysqli_fetch_array($promos)){
            if($editar["prd_promo_id"]!= $promo["promo_id"]){
                echo '<option value="'.$promo["promo_id"].'">'.$promo["promo_nome"].'</option>';
            }else{
                echo '<option value="'.$editar["prd_promo_id"].'" selected>'.$promo["promo_nome"].'</option>';
            }
        }
    echo '</td>';
    echo '<td>
    <input type="hidden" name="prd_id" value ="'.$editar["prd_id"].'">
    <input type="submit" name="atualizar_prd" value ="Inserir" class="edit_bt"</td>';
    echo '</tr>';
    include '../connections/deconn.php';

}

function atualizar_prd($prd_nome, $prd_ref, $prd_preco, $prd_descricao, $foto, $prd_id, $prd_promo_id){
    include '../connections/conn.php';
    $prd= mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM produtos WHERE prd_id = '$prd_id'"));
    if ($foto == '') {
        $foto = $prd["prd_foto"];
    }
    mysqli_query($conn, "UPDATE produtos SET prd_nome='$prd_nome', prd_preco='$prd_preco', prd_descricao='$prd_descricao', prd_foto='$foto', prd_destaque='0', prd_ref='$prd_ref', prd_promo_id = '$prd_promo_id' WHERE prd_id = '$prd_id'");
                        
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=2">';

}



function lista_stocks(){
    include '../connections/conn.php';
    $stocks = mysqli_query($conn,"select stocks.*, produtos.* from stocks join produtos on stocks.stock_prd_id = produtos.prd_id");
    while ($stock = mysqli_fetch_array($stocks)){
    echo '<form method="post"';
    echo '<tr>';
    echo '<td>';
    echo '<img src="../img/'.$stock["prd_foto"].'">';
    echo '</td>';
        echo '<td>';
        echo '</td>';
    echo '<td>'.$stock["prd_nome"].'</td>';
    echo '<td>'.$stock["prd_ref"].'</td>';
    echo '<td>'.$stock["prd_preço"].'</td>';
    echo '<td><input type="number" name="stock_qta" value="'.$stock["stock_qta"].'"</td>';
    echo '<td>';
    echo '<input type="hidden" name="stock_prd_id" value ="'.$stock["prd_id"].'">';
    echo '<input type="submit" name="atualizar_stock" value ="Atualizar" class="edit_bt"</td>';
    echo '</tr>';
    echo '</form>';
    }
    
    
    include '../connections/deconn.php';
}


function update_stock($stock_qta,$stock_prd_id){
    include '../connections/conn.php';
    mysqli_query($conn,"update stocks set stock_qta = '$stock_qta' where stock_prd_id = '$stock_prd_id'");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=3">';
}


function lista_promo(){
    include '../connections/conn.php';
    $promos = mysqli_query($conn,"select * from promos");
    while($promo = mysqli_fetch_array($promos)){
    echo '<form method="post">';
    echo '<tr>';
    echo '<td>'.$promo["promo_nome"].'</td>';
        echo '<td></td>';
    echo '<td>'.$promo["promo_val"].'</td>';
    echo '<td>';
    echo '<input type="hidden" name="promo_id" value ="'.$promo["promo_id"].'">';
    echo '<input type="submit" name="apagar_promo" value ="Apagar" class="del_bt"</td>';
    echo '</tr>';
    echo '</form>';
    }
    include '../connections/deconn.php';
}



function nova_promo($promo_nome,$promo_valor){
    include '../connections/conn.php';
    mysqli_query($conn,"insert into promos(promo_nome, promo_val) values('$promo_nome','$promo_valor')");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=4">';

}

function apagar_promo($promo_id){
    include '../connections/conn.php';
    mysqli_query($conn,"delete from promos where promo_id = '$promo_id'");
    include '../connections/deconn.php';
    echo '<meta http-equiv="refresh" content="0;url=index.php?opt=4">';
}






?>