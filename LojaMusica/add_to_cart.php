<?php
session_start();
$prd_id  = $_REQUEST["prd_id"];
$prd_qta = $_REQUEST["prd_qta"];
include 'connections/conn.php';
//recolher id do carrinho
$carrinho_ativo = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM carrinhos WHERE carrinhos_ref = '$_SESSION[carrinho_ref]'"));
//ver se ja existe este artigo neste carrinho
$pre_item = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM carrinho_items WHERE items_carrinhos_id = '$carrinho_ativo[carrinhos_id]' AND items_prd_id = '$prd_id'"));
if ($pre_item["items_prd_id"] == '') {
    //nao ha este artigo no carinho ADD
    mysqli_query($conn, "INSERT INTO carrinho_items (items_carrinhos_id, items_prd_id, items_prd_qta)
    VALUES ('$carrinho_ativo[carrinhos_id]','$prd_id','$prd_qta')");
} else {
    //ja existe este artigo no carrinho ADD X QTA
    $new_qta = $pre_item["items_prd_qta"]+$prd_qta;
    mysqli_query($conn, "UPDATE carrinho_items SET items_prd_qta = '$new_qta' WHERE items_prd_id = '$prd_id' AND items_carrinhos_id = '$carrinho_ativo[carrinhos_id]'");
}
include 'connections/deconn.php';
echo '<meta http-equiv="refresh" content="0;url=index.php">';
?>