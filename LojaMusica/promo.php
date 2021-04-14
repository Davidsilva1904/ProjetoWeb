<?php
session_start();
require 'includes/functions.php';
carrinhos();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Promo</title>
	<link rel="stylesheet" type="text/css" href="css/estilosvinyl.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
</head>
<body>
	<!-- Cabeçalho -->
<?php // arranca php e faz a inclusão do codigo do ficheiro indicado
include 'includes/header.php';
?>
<!-- Fim Cabeçalho -->
<!-- Nav -->
<?php
include 'includes/nav.php';
?>
<!-- Fim Nav -->
<?php
include 'includespromo/main1.php';
?>

<?php
include 'includes/footer.php';
?>

</body>
</html>