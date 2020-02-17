<?php
    include_once 'con_db-2.php';
    
	$id_expedidora = mysqli_real_escape_string($con, $_POST['id']);
	$nome_expedidora = mysqli_real_escape_string($con, $_POST['nomeexpedidora']);
	$codigo_emec_expedidora = mysqli_real_escape_string($con, $_POST['codigoemecexpedidora']);
	$status_expedidora = mysqli_real_escape_string($con, $_POST['status_expedidora']);

	$result_expedidora = "UPDATE ies_expedidoras SET 
	nome_expedidora='$nome_expedidora', 
	codigo_emec_expedidora='$codigo_emec_expedidora',
	status_expedidora='$status_expedidora'
	
	WHERE id_expedidora='$id_expedidora'";
	
	$resultado_expedidora = mysqli_query($con, $result_expedidora);	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> <?php
		if(mysqli_affected_rows($con) != 0){
			echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro da Expedidora foi alterado com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro da Expedidora não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>