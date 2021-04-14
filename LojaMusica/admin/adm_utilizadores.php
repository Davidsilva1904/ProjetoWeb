   <div class="top_info">
    <div class="top_info_titulo">
        <?php
            top_info_titulo($opt);
@$del = $_REQUEST["del"];
if($del !=''){
    delete_utilizador($del);
}
        ?>

    </div>
    <div class="top_info_opt">
        <a href="?opt=1&new_user=1"><button class="add_bt">Adicionar +</button></a>
    </div>
</div>
<hr>
<div class="adm_content">

    <table class="table_head">
        <tr>
            <th>ID</th>
            <th>Email:</th>
            <th>Nome:</th>
            <th>Morada:</th>
            <th>Telefone:</th>
            <th></th>
        </tr>
    </table>
    <!-- Dados Variáveis-->
    <table class="table_head">
<?php
@$edit = $_REQUEST["edit"];
    if($edit != ''){
        echo '<form method="post"><table>';
        edicao_utilizador($edit);
        echo '</table></form>';
}else{
    @$new_user = $_REQUEST["new_user"];
    if($new_user != ''){
        echo '<form method="post"><table>';
        echo ' <tr>
            <td></td>
            <td><input type="email" placeholder="Email:" name="log_email"></td>
            <td><input type="text" placeholder="Nome:" name="dados_nome">
                <input type="text" placeholder="Sobrenome:" name="dados_apelido">
            </td>
            <td><input type="text" placeholder="Morada" name="dados_morada">
                <input type="text" placeholder="Codigo Postal" name="dados_cp">
                <input type="text" placeholder="Localidade" name="dados_localidade">
            </td>
            <td><input type="text" placeholder="Telefone" name="dados_telefone"></td>

            <td>
            <input type ="submit" name="novo_utilizador" class ="edit_bt" value="Criar Utilizador"</td>
        </tr>';;
        echo '</table></form>';

    }
    echo '<table>';
        lista_utilizadores();
    echo '<table>';
}


if(isset($_POST["atualizar_utilizador"])){
    atualizar_utilizador($_POST["log_email"], $_POST["dados_nome"], $_POST["dados_apelido"], $_POST["dados_morada"], $_POST["dados_cp"], $_POST["dados_localidade"], $_POST["dados_telefone"], $_POST["dados_id"],$_POST["log_id"]);
}
if(isset($_POST["novo_utilizador"])){
    novo_utilizador($_POST["log_email"], $_POST["dados_nome"], $_POST["dados_apelido"], $_POST["dados_morada"], $_POST["dados_cp"], $_POST["dados_localidade"], $_POST["dados_telefone"]);
}

?>
</div>
<hr>
