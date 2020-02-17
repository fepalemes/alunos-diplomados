<?php 
ob_start();
session_start();

require_once 'class/con_db-2.php';

if(isset($_SESSION['status_usuario'])=='Ativo')
{
	$query1= mysqli_query($con,"SELECT * FROM `usuarios_fames` WHERE `id_usuario`='".$_SESSION['id_usuario']."' AND `status_usuario`='Ativo' ");

	while($arr1 = mysqli_fetch_array($query1)){
	$_SESSION['id_usuario']= $arr1["id_usuario"];
	$_SESSION['nome_usuario']= $arr1["nome_usuario"];
	$_SESSION['email_usuario']= $arr1["email_usuario"];
	$_SESSION['senha_usuario']= $arr1["senha_usuario"];
	$_SESSION['status_usuario']= $arr1["status_usuario"];
}

$num1 = mysqli_num_rows($query1); 

if($num1==1){    
?>

<!doctype html>
<head>
	<title>Alunos | Registro de diplomas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">	
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
			<a href="index.php"><img src="assets\img\logo_transparente1.png" alt="logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo $_SESSION['nome_usuario']?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="../logout.php"><i class="lnr lnr-exit"></i> <span>Sair</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="cursos.php" class=""><i class="lnr lnr-list"></i> <span>Cursos</span></a></li>
						<li><a href="exp_reg.php" class=""><i class="lnr lnr-list"></i> <span>Expedidoras e Registradoras</span></a></li>
						<li><a href="alunos.php" class="active"><i class="lnr lnr-graduation-hat"></i> <span>Alunos</span></a></li>
						<li><a href="usuarios.php" class=""><i class="lnr lnr-users"></i> <span>Usuários</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Alunos diplomados</h3>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cadastro_aluno">Novo cadastro de aluno diplomado</button>
					<br>
					<br>
					<!-- inicio modal de adicionar aluno-->
					<div class="modal fade" id="Cadastro_aluno" tabindex="-1" role="dialog" aria-labelledby="Cadastro_aluno" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="TituloModalCentralizado">Formulário de cadastro de aluno diplomado</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" action="class/insert-alunos.php">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Nome do aluno</label>
									<input type="text" class="form-control" name="nome_aluno" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">CPF</label>
									<input type="text" class="form-control" name="cpf_aluno" onkeyup="javascript:jsPCPFCNPJ(this);" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Dígitos centrais do CPF</label>
									<input type="text" class="form-control" name="cpf_digitos_aluno" required>
								</div>
								<div class="form-group">
   							 <label for="exampleFormControlSelect1">Curso do aluno</label>
									<select class="form-control" name="curso_aluno" required>
									<option>Selecione o curso do aluno</option>
									<?php
									$lista_cursos = "SELECT * FROM `cursos_fames` WHERE `excluido`='Nao' AND `status_curso`='Ativo'";

										$mostrar_lista_cursos = mysqli_query($con, $lista_cursos);

										while ($row = mysqli_fetch_object($mostrar_lista_cursos)) {
											echo '<option value="'.$row->id_curso.'">'.$row->nome_curso.' - Cód. EMEC: '.$row->codigo_emec_curso.'</option>'."\n";
										}
									?>
									</select>
								</div>
								<div class="form-group">
   							 		<label for="exampleFormControlSelect1">Expedidora do diploma</label>
									<select class="form-control" name="expedidora_aluno" required>
									<option>Selecione a expedidora do diploma</option>
									<?php
									$lista_expedidoras = "SELECT * FROM `ies_expedidoras` WHERE `excluido`='Nao' AND `status_expedidora`='Ativo'  ";

										$mostrar_lista_expedidoras = mysqli_query($con, $lista_expedidoras);

										while ($row = mysqli_fetch_object($mostrar_lista_expedidoras)) {
											echo '<option value="'.$row->id_expedidora.'">'.$row->nome_expedidora.' - Cód. EMEC: '.$row->codigo_emec_expedidora.'</option>'."\n";
										}
									?>
									</select>
								</div>
								<div class="form-group">
   							 	<label for="exampleFormControlSelect1">Registradora do diploma</label>
									<select class="form-control" name="registradora_aluno" required>
									<option>Selecione a registradora do diploma</option>
									<?php
									$lista_registradoras = "SELECT * FROM `ies_registradoras` WHERE `excluido`='Nao' AND `status_registradora`='Ativo' ";

										$mostrar_lista_registradoras = mysqli_query($con, $lista_registradoras);

										while ($row = mysqli_fetch_object($mostrar_lista_registradoras)) {
											echo '<option value="'.$row->id_registradora.'">'.$row->nome_registradora.' - Cód. EMEC: '.$row->codigo_emec_registradora.'</option>'."\n";
										}
									?>
									</select>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Data de ingresso no curso</label>
									<input class="form-control" type="date" name="dt_ingresso" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Data de conclusão do curso</label>
									<input class="form-control" type="date" name="dt_conclusao" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Data de expedição do diploma</label>
									<input class="form-control" type="date" name="dt_expedicao_diploma" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Data de registro do diploma</label>
									<input class="form-control" type="date" name="dt_registro_diploma" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Número de expedição do diploma</label>
									<input type="text" class="form-control" name="num_expedicao" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Número de registro do diploma</label>
									<input type="text" class="form-control" name="num_registro" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Data de registro no DOU</label>
									<input class="form-control" type="date" name="dt_registro_dou" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								
								<input type="submit" value="Cadastrar aluno" button type="button" class="btn btn-primary"></button>
								</form>
							</div>
							</div>
						</div>
						</div>
						<!-- fim modal de adicionar aluno -->		
					<input type="search" class="form-control" id="pesquisa" onkeyup="myFunction()" placeholder="Digite o nome do aluno para pesquisa...">		
					<div class="row">
						<div class="col-md-12">		
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
								<div class="panel-body">
									<table id="tabela_alunos" class="table table-hover">
										<thead>
											<tr>
												<th>Nome Aluno</th>
												<th>CPF</th>
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
												<th>Status do aluno</th>
												<th>Opções</th>
											</tr>
										</thead>
										<?php 
										$lista_alunos = "SELECT * FROM alunos_fames = AF
			
															INNER JOIN cursos_fames = CF
															ON AF.id_curso_aluno = CF.id_curso
															
															INNER JOIN ies_expedidoras = IES_exp
															ON AF.id_expedidora = IES_exp.id_expedidora 

															INNER JOIN ies_registradoras = IES_reg
															ON AF.id_registradora = IES_reg.id_registradora WHERE AF.excluido = 'Nao'";

										$mostrar_lista_alunos = mysqli_query($con, $lista_alunos);
										while ($row = mysqli_fetch_array($mostrar_lista_alunos)) { 
										?>

										<tr> 
											<td><?php echo $row['nome_aluno']; ?></td>
											<td><?php echo $row['cpf']; ?></td>
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
											<td><?php echo $row['status_aluno']; ?></td>
											<td>
											<!-- Botao modal edição aluno -->
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" 
											data-whateverid="<?php echo $row['id_aluno']; ?>" 
											data-whatevernome="<?php echo $row['nome_aluno']; ?>"
											data-whatevercpf="<?php echo $row['cpf']; ?>"
											data-whateverdigitoscpf="<?php echo $row['digitos_cpf']; ?>"
											data-whateverdataingresso="<?php echo $row['data_ingresso_curso']; ?>"
											data-whateverdataconclusao="<?php echo $row['data_conclusao_curso']; ?>"
											data-whateverdataexpedicao="<?php echo $row['data_expedicao_curso']; ?>"		
											data-whateverdataregistro="<?php echo $row['data_registro_diploma']; ?>"
											data-whatevernumexpedicao="<?php echo $row['id_num_expedicao']; ?>"
											data-whatevernumregistro="<?php echo $row['id_num_registro']; ?>"
											data-whateverdataregistrodou="<?php echo $row['data_registro_dou']; ?>">Editar aluno
											</button>
										</td>
											<form method="post">
												<input type="hidden" name="id_aluno" value="<?php echo $row['id_aluno'] ?>">
												<td>
													<button type="submit" name="excluir" id="excluir" value="excluir" class="btn btn-xs btn-danger">Excluir aluno
													</button>
												</td>
											</form>
										</tr>
									</tbody>
									<?php }	?>
									<?php
										if(isset($_POST['id_aluno'])){
											
											$id_aluno_excluir = $_POST['id_aluno'];

										if(isset($_POST['excluir'])) {		
											
											$excluir = "UPDATE alunos_fames SET excluido = 'Sim' WHERE id_aluno = '$id_aluno_excluir'";

											$executa_exclusao_aluno = mysqli_query($con, $excluir);
											} 	
											if($executa_exclusao_aluno){
											
													echo "<meta http-equiv='refresh' content='0, url=alunos.php'";
												}    
											}
									?>
									</table>
								</div>
							</div>
							<!-- INICIO modal editar aluno -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Editar aluno</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="class/edit-alunos.php" enctype="multipart/form-data">
												<!-- nome aluno -->
												<div class="form-group">
													<label for="nome" class="control-label">Nome:</label>
													<input name="nome" type="text" class="form-control" id="nome" required>
												</div>
												<!-- cpf aluno -->
												<div class="form-group">
													<label for="cpf" class="control-label">CPF:</label>
													<input name="cpf" type="text" class="form-control" id="cpf" onkeyup="javascript:jsPCPFCNPJ(this);" max="14" required>
												</div>
												<!-- digitos cpf aluno -->	
												<div class="form-group">
													<label for="digitoscpf" class="control-label">Dígitos CPF:</label>
													<input name="digitoscpf" type="text" class="form-control" id="digitoscpf" max="7" required>
												</div>
												<!-- data ingresso curso aluno -->
												<div class="form-group">
													<label for="dataingresso" class="col-form-label">Data de ingresso no curso</label>
													<input class="form-control" type="date" name="dataingresso" id="dataingresso" required>
												</div>
												<!-- data de conclusao curso aluno -->
												<div class="form-group">
													<label for="dataconclusao" class="col-form-label">Data de conclusão do curso</label>
													<input class="form-control" type="date" name="dataconclusao" id="dataconclusao" required>
												</div>
												<!-- data de expedicao diploma aluno -->
												<div class="form-group">
													<label for="dataexpedicao" class="col-form-label">Data de expedição do diploma</label>
													<input class="form-control" type="date" name="dataexpedicao" id="dataexpedicao" required>
												</div>
												<!-- data de registro diploma aluno -->
												<div class="form-group">
													<label for="dataregistro" class="col-form-label">Data de registro do diploma</label>
													<input class="form-control" type="date" name="dataregistro" id="dataregistro" required>
												</div>
												<!-- numero expedicao diploma aluno -->
												<div class="form-group">
													<label for="numexpedicao" class="control-label">Número de expedição do diploma</label>
													<input name="numexpedicao" type="text" class="form-control" id="numexpedicao" required>
												</div>
												<!-- numero registro diploma aluno -->
												<div class="form-group">
													<label for="numregistro" class="control-label">Número de registro do diploma</label>
													<input name="numregistro" type="text" class="form-control" id="numregistro" required>
												</div>
												<!-- data de registro no DOU aluno -->
												<div class="form-group">
													<label for="dataregistrodou" class="col-form-label">Data de registro no DOU</label>
													<input class="form-control" type="date" name="dataregistrodou" id="dataregistrodou" required>
												</div>
												<!-- status aluno -->
												<div class="form-group">
													<label for="status_aluno">Status aluno</label>
													<select class="form-control" name="status_aluno" id="status_aluno" required>
													<option selected value="Ativo">Ativo</option>
													<option value="Inativo">Inativo</option>
													</select>
												</div>
												<!-- submit do modal de alterações -->
												<div class="modal-footer">
													<input name="id" type="hidden" class="form-control" id="id" value="id">
													<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-primary">Salvar alterações</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div> 
							<!-- FIM modal editar aluno -->	
						</div>		
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright"><a href="" target="_blank">Faculdade </a>| Desenvolvido por </p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
<script src="assets/js/campos.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- INICIO JS modal -->
<script type="text/javascript">
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget)
		  var recipient = button.data('whateverid')
		  var recipientnome = button.data('whatevernome')
		  var recipientcpf = button.data('whatevercpf')
		  var recipientdigitoscpf = button.data('whateverdigitoscpf')
		  var recipientdataingresso = button.data('whateverdataingresso')
		  var recipientdataconclusao = button.data('whateverdataconclusao')	
		  var recipientdataexpedicao = button.data('whateverdataexpedicao')	
		  var recipientdataregistro = button.data('whateverdataregistro')
		  var recipientnumexpedicao = button.data('whatevernumexpedicao')	  
		  var recipientnumexpedicao = button.data('whatevernumexpedicao')
		  var recipientnumregistro = button.data('whatevernumregistro')
		  var recipientdataregistrodou = button.data('whateverdataregistrodou')

		  var modal = $(this)

		  modal.find('.modal-title').text('Editar cadastro - ' + recipientnome)
		  modal.find('#id').val(recipient)
		  modal.find('#nome').val(recipientnome)
		  modal.find('#cpf').val(recipientcpf)
		  modal.find('#digitoscpf').val(recipientdigitoscpf)
		  modal.find('#dataingresso').val(recipientdataingresso)
		  modal.find('#dataconclusao').val(recipientdataconclusao)
		  modal.find('#dataexpedicao').val(recipientdataexpedicao)
		  modal.find('#dataregistro').val(recipientdataregistro)
		  modal.find('#numexpedicao').val(recipientnumexpedicao)
		  modal.find('#numregistro').val(recipientnumregistro)
		  modal.find('#dataregistrodou').val(recipientdataregistrodou)	  
		})
	</script>
<!-- FIM JS modal -->

	<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("pesquisa");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela_alunos");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>

</html>
<?php 
   }
    else
    {
      header ("location:../login.php");
      }
    }    
	else
    header ("location:../login.php");
?>