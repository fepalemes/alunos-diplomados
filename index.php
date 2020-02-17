<?php 
require_once("core/class/con_db-1.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consulta | Registro de diplomas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="core/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="core/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="core/assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="core/assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="core/assets/img/favicon.png">
</head>
<body><div class="form-group pull-left">
<div class="col-md-4">
<br>
	<form method="post">
		<div class="input-group">
			<input id="pesquisa" name="pesquisa" type="search" placeholder="Realize a busca pelo CPF do aluno" class="form-control" onkeyup="javascript:jsPCPFCNPJ(this);" required   pattern=".{0}|.{14,}"   required title="Informe o CPF completo">
			<span class="input-group-btn"><button type="submit" class="btn btn-primary" type="button">Pesquisar</button></span>
		</div>
	</form>
</div>
</div>
<span class="counter pull-right"></span>

<!-- TABLE HOVER -->
<div class="panel">
	<div class="panel-heading">
		<div class="panel-body">
			<table class="table table-hover">
			<thead>
				<tr>
					<th>Nome Aluno</th>
					<th>Dígitos CPF</th>
					<th>Curso</th>
					<th>Expedidora</th>
					<th>Registradora</th>
					<th>Data de ingresso</th>
					<th>Data de conclusão</th>
					<th>Data de expedição - Diploma</th>
					<th>Data de registro - Diploma</th>
					<th>Número expedição</th>
					<th>Número registro</th>
					<th>Data de registro DOU</th>
				</tr>
			</thead>							
			<?php 
       			 if(isset($_POST['pesquisa'])){ 
		  		 $pesquisa=$_POST['pesquisa'];
		  		 $query1=mysql_query("SELECT * FROM alunos_fames = AF
                              
                              INNER JOIN cursos_fames = CF
                              ON AF.id_curso_aluno = CF.id_curso
                              
                              INNER JOIN ies_expedidoras = IES_exp
                              ON AF.id_expedidora = IES_exp.id_expedidora 

                              INNER JOIN ies_registradoras = IES_reg
                              ON AF.id_registradora = IES_reg.id_registradora 
                          
                              WHERE AF.cpf = '$pesquisa' AND AF.excluido = 'Nao' AND AF.status_aluno = 'Ativo'				  
			 ");
				if (mysql_num_rows($query1) > 0) {
                while ($row = mysql_fetch_array($query1)) {   ?>
				<tr> 
                    <td><?php echo $row['nome_aluno']; ?></td>
                    <td><?php echo $row['digitos_cpf']; ?></td>
                    <td><?php echo $row['nome_curso']; ?> | Cód. EMEC: <?php echo $row['codigo_emec_curso']; ?></td>
                    <td><?php echo $row['nome_expedidora']; ?> | Cód. EMEC: <?php echo $row['codigo_emec_expedidora']; ?></td>
					<td><?php echo $row['nome_registradora']; ?> | Cód. EMEC: <?php echo $row['codigo_emec_registradora']; ?></td>
					<td><?php echo date("d/m/Y", strtotime($row['data_ingresso_curso'])); ?></td>
				   	<td><?php echo date("d/m/Y", strtotime($row['data_conclusao_curso'])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['data_expedicao_curso'])); ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['data_registro_diploma'])); ?></td>
                    <td><?php echo $row['id_num_expedicao']; ?></td>
                    <td><?php echo $row['id_num_registro']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['data_registro_dou'])); ?></td>
                </tr>
			</tbody>	  
			<?php  }
					} else{ 
						echo '<br><br><div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						<i class="fa fa-times-circle"></i> Não foi encontrado nenhum aluno com o CPF informado.
               			 </div>';
             		 }
         		   }
      		?>
			</table>
		</div>
	</div>
	<script src="core/assets/js/campos.js" type="text/javascript"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
</body>
</html>