<?php
    include_once 'con_db-2.php';
    
	$id_aluno = mysqli_real_escape_string($con, $_POST['id']);
	$nome_aluno = mysqli_real_escape_string($con, $_POST['nome']);
	$cpf = mysqli_real_escape_string($con, $_POST['cpf']);
	$digitoscpf = mysqli_real_escape_string($con, $_POST['digitoscpf']);
	$dataingresso = mysqli_real_escape_string($con, $_POST['dataingresso']);
	$dataconclusao = mysqli_real_escape_string($con, $_POST['dataconclusao']);
	$dataexpedicao = mysqli_real_escape_string($con, $_POST['dataexpedicao']);
	$dataregistro = mysqli_real_escape_string($con, $_POST['dataregistro']);
	$numexpedicao = mysqli_real_escape_string($con, $_POST['numexpedicao']);
	$numregistro = mysqli_real_escape_string($con, $_POST['numregistro']);
	$dataregistrodou = mysqli_real_escape_string($con, $_POST['dataregistrodou']);
	$status_aluno = mysqli_real_escape_string($con, $_POST['status_aluno']);
	
	$result_aluno = "UPDATE alunos_fames SET 
	nome_aluno='$nome_aluno', 
	cpf='$cpf',
	digitos_cpf='$digitoscpf',
	data_ingresso_curso='$dataingresso',
	data_conclusao_curso='$dataconclusao',
	data_expedicao_curso='$dataexpedicao',
	data_registro_diploma='$dataregistro',
	id_num_expedicao='$numexpedicao',
	id_num_registro='$numregistro',
	data_registro_dou='$dataregistrodou',
	status_aluno='$status_aluno'
	
	WHERE id_aluno='$id_aluno'";
	
	$resultado_aluno = mysqli_query($con, $result_aluno);	
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
					alert(\"O cadastro do aluno foi alterado com sucesso.\");
				</script>
				";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>
				<script type=\"text/javascript\">
					alert(\"O cadastro do aluno não foi alterado, tente novamente.\");
				</script>
			";	
		}?>
	</body>
</html>
<?php $con->close(); ?>