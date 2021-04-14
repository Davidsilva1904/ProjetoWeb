   <div class="top_info">
    <div class="top_info_titulo">
        <?php
            top_info_titulo($opt);
        ?>

    </div>
    <div class="top_info_opt">
       <!-- <button class="add_bt">Adicionar +</button>-->
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
            <th>Quantidade:</th>
        </tr>
    </table>
<?php
echo '<table>';
lista_stocks();  
echo '</table>';
    
if(isset($_POST["atualizar_stock"])){
    update_stock($_POST["stock_qta"],$_POST["stock_prd_id"]);
}
?>

</div>
<hr>