<?php
    include_once 'con_db-2.php';
    
	$id_usuario = mysqli_real_escape_string($con, $_POST['id']);
    $senha_usuario = mysqli_real_escape_string($con, $_POST['senhausuario']);
    $senha_usuario_MD5=MD5($senha_usuario);  

	$result_usuario = "UPDATE usuarios_fames SET 
	
	senha_usuario='$senha_usuario_MD5'
	
	WHERE id_usuario='$id_usuario'";
	
	$resultado_usuario = mysqli_query($con, $result_usuario);	
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
					alert(\"A senha do usuário foi alterada com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"A senha do usuário não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>