   <div class="top_info">
    <div class="top_info_titulo">
        <?php
            top_info_titulo($opt);
        ?>

    </div>
    <div class="top_info_opt">
       <a href="?opt=4&new_promo=1"><button class="add_bt">Adicionar +</button></a>
    </div>
</div>
<hr>
<div class="adm_content">

    <table class="table_head">
        <tr>
            <th>Nome:</th>
            <th>Promoção:</th>
            <th></th>
        </tr>
    </table>
  <?php
@$new_promo = $_REQUEST["new_promo"];
if($new_promo != ''){
    echo '<form method="post">';
    echo '<table>';
    echo '<tr>';
    echo '<td><input type = "text" name="promo_nome" placeholder="Nome"</td>';
    echo '<td></td>';
    echo '<td>';
    echo '<select name="promo_valor">';
    for($i=0;$i <70;$i++){
        echo'<option value='.$i.'">'.$i.'%</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td><input type="submit" name="insert_promo" value ="Inserir" class="edit_bt"></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
}


echo '<table>';
lista_promo();
echo '</table>';

if(isset($_POST["insert_promo"])){
    nova_promo($_POST["promo_nome"],$_POST["promo_valor"]);
}

if(isset($_POST["apagar_promo"])){
    apagar_promo($_POST["promo_id"]);
}    
?>






</div>
<hr>