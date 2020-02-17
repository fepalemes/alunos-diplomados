<?php
    include_once 'con_db-2.php';
    
	$id_usuario = mysqli_real_escape_string($con, $_POST['id']);
	$nome_usuario = mysqli_real_escape_string($con, $_POST['nomeusuario']);
	$email_usuario = mysqli_real_escape_string($con, $_POST['emailusuario']);  
    $senha_usuario = mysqli_real_escape_string($con, $_POST['senhausuario']);
    $senha_usuario_MD5=MD5($senha_usuario);
    $nivel_usuario = mysqli_real_escape_string($con, $_POST['nivelusuario']);
    $status_usuario = mysqli_real_escape_string($con, $_POST['statususuario']);

	$result_usuario = "UPDATE usuarios_fames SET 
	nome_usuario='$nome_usuario', 
	email_usuario='$email_usuario',
	senha_usuario='$senha_usuario_MD5',
    nivel_usuario='$nivel_usuario',
    status_usuario='$status_usuario'
	
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
					alert(\"O cadastro do usuário foi alterado com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro do usuário não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>