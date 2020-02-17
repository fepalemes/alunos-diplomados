<?php
    include_once 'con_db-2.php';
    
	$id_curso = mysqli_real_escape_string($con, $_POST['id']);
	$nome_curso = mysqli_real_escape_string($con, $_POST['nomecurso']);
	$codigo_emec_curso = mysqli_real_escape_string($con, $_POST['codigoemeccurso']);
	$status_curso = mysqli_real_escape_string($con, $_POST['status_curso']);

	$result_curso = "UPDATE cursos_fames SET 
	nome_curso='$nome_curso', 
	codigo_emec_curso='$codigo_emec_curso',
	status_curso='$status_curso'
	
	WHERE id_curso='$id_curso'";
	
	$resultado_curso = mysqli_query($con, $result_curso);	
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
					alert(\"O cadastro do curso foi alterado com sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro do curso não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>