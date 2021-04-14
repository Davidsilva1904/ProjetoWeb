<header>
	<div class="bt_header_menu" id="topo">
		<span class="fas fa-bars"></span>
	</div>
	<div id="logotipo"><a href=index.php>Loja de Música Margem Sul</div></a>
	
<?php
if (@!$_SESSION["log_id"]) {//@ faz a supressao de warnings
	echo '
		<a href="login.php">
		<div class="bt_header">
		<span class="fas fa-user"></span>Login
		</div>
		</a>
	';
} else {
	echo '
	<a href="aminhaconta.php">
		<div class="bt_header">
		<span class="fas fa-user"></span> A Minha Conta
		</div>
	</a>
	';
}
?>
	<div class="bt_header"><a href="cestocompras.php">
		<span class="fas fa-compact-disc"></span>O seu cesto (0)
	</div></a>

	<div class="bt_header_mob">
		<span class="fas fa-user"></span>
	</div>
	<div class="limpa"></div>
</header>