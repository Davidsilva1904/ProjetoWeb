   <div class="top_info">
    <div class="top_info_titulo">
        <?php
            top_info_titulo($opt);
                @$del = $_REQUEST["del"];
                if ($del != ''){
                    //unlink('test.html');
                    apagar_prd($del);
                }
        ?>

    </div>
    <div class="top_info_opt">
    <a href="?opt=2&new_prd=1"><button class="add_bt">Adicionar +</button></a>
    </div>
</div>
<hr>
<div class="adm_content">

    <table class="table_head_prd">
        <tr>
            <th>Id:</th>
            <th>Foto:</th>
            <th>Nome:</th>
            <th>Ref:</th>
            <th>Preço:</th>
            <th>Descrição:</th>
        </tr>
    </table>


<?php
@$new_prd = $_REQUEST["new_prd"];
if($new_prd != ''){
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<input type ="file" name="prd_foto">';
    echo '</td>';
    echo '<td><input type = "text" name="prd_nome" placeholder="Nome"</td>';
    echo '<td><input type = "text" name="prd_ref" placeholder="Referencia"</td>';
    echo '<td><input type = "number" name="prd_preço" placeholder="Preco"</td>';
    echo '<td><textarea name="prd_descricao"></textarea></td>';
    echo '<td><input type="submit" name="new_prd" value ="Inserir" class="edit_bt"></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
}

@$edit = $_REQUEST["edit"];
if($edit != ''){
        echo '<form method="post" enctype="multipart/form-data"><table>';
        edicao_prd($edit);
        echo '</table></form>';
}else{
    echo '<table>';
    lista_prds();
    echo '</table>';
}
?>

<?php
if (isset($_POST["new_prd"])){
  $foto = $_FILES['prd_foto']['name'];
    // move_uploaded_file($_FILES['prd_foto']['tmp_name'], '../img/'.$foto);
    new_prd($_POST["prd_nome"],$_POST["prd_ref"],$_POST["prd_preço"],$_POST["prd_descricao"],$foto);
    echo "here";

}

if(isset($_POST["atualizar_prd"])) {
    $foto = $_FILES['prd_foto']['name'];
    move_uploaded_file($_FILES['prd_foto']['tmp_name'], '../img/'.$foto);
    atualizar_prd($_POST["prd_nome"],$_POST["prd_ref"],$_POST["prd_preço"],$_POST["prd_descricao"],$foto, $_POST["prd_id"],$_POST["prd_promo_id"]);
}

?>
</div>
<hr>