   <div class="top_info">
    <div class="top_info_titulo">
        <?php
            top_info_titulo($opt);
        ?>

    </div>
    <div class="top_info_opt">
        <button class="add_bt">Adicionar +</button>
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
        lista_utilizadores();
           ?>
        
    </table>

</div>
<hr>