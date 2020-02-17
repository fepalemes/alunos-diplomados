<?php
    include_once 'con_db-2.php';
    
	$id_registradora = mysqli_real_escape_string($con, $_POST['id']);
	$nome_registradora = mysqli_real_escape_string($con, $_POST['nomeregistradora']);
	$codigo_emec_registradora = mysqli_real_escape_string($con, $_POST['codigoemecregistradora']);
	$status_registradora = mysqli_real_escape_string($con, $_POST['status_registradora']);

	$result_registradora = "UPDATE ies_registradoras SET 
	nome_registradora='$nome_registradora', 
	codigo_emec_registradora='$codigo_emec_registradora',
	status_registradora='$status_registradora'
	
	WHERE id_registradora='$id_registradora'";
	
	$resultado_registradora = mysqli_query($con, $result_registradora);	
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
					alert(\"O cadastro da Registradora foi alterado com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro da Registradora não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>