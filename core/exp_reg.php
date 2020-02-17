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

if($num1==1)

{    

?>
<!doctype html>
<html lang="en">
<head>
	<title>Expedidoras e registradoras | Registro de diplomas</title>
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
						<li><a href="exp_reg.php" class="active"><i class="lnr lnr-list"></i> <span>Expedidoras e Registradoras</span></a></li>
						<li><a href="alunos.php" class=""><i class="lnr lnr-graduation-hat"></i> <span>Alunos</span></a></li>
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
					<h3 class="page-title">Expedidoras e Registradoras</h3>
					<div class="row">
						<div class="col-md-6">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cadastro_expedidora">Novo cadastro de expedidora</button>
						<!-- inicio modal de adicionar expedidora-->
						<div class="modal fade" id="Cadastro_expedidora" tabindex="-1" role="dialog" aria-labelledby="Cadastro_expedidora" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="TituloModalCentralizado">Cadastro de expedidora</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" action="class/insert-expedidora.php">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Nome expedidora</label>
									<input type="text" class="form-control" name="nome_expedidora" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Código EMEC expedidora</label>
									<input type="text" class="form-control" name="codigo_emec_expedidora" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<input type="submit" value="cadastrar Expedidora" button type="button" class="btn btn-primary"></button>
								</form>
							</div>
							</div>
						</div>
						</div>
						<!-- fim modal de adicionar expedidora -->
						<p>
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Expedidoras</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Nome expedidora</th>
												<th>Código EMEC expedidora</th>
												<th>Status expedidora</th>
												<th>Opções</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$lista_expedidoras = "SELECT * FROM `ies_expedidoras` WHERE `excluido`='Nao' ";
										$mostrar_lista_expedidoras = mysqli_query($con, $lista_expedidoras);
										while ($row = mysqli_fetch_array($mostrar_lista_expedidoras)) {
											$id_expedidora = $row['id_expedidora']
										?>
										<tr> 
											<td><?php echo $row['nome_expedidora'] ?></td>
											<td><?php echo $row['codigo_emec_expedidora'] ?></td>
											<td><?php echo $row['status_expedidora'] ?></td>
											<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editarexpedidora" 
											data-whateverid="<?php echo $row['id_expedidora']; ?>" 
											data-whatevernomeexpedidora="<?php echo $row['nome_expedidora']; ?>"
											data-whatevercodigoemecexpedidora="<?php echo $row['codigo_emec_expedidora']; ?>">Editar</button>
											</td>
											<form method="post">
											<input type="hidden" name="id_expedidora" value="<?php echo $row['id_expedidora'] ?>">
												<td><button type="submit" name="excluir" id="excluir" value="excluir" class="btn btn-xs btn-danger">Excluir</button></td>
											</form>
										</tr>
										<?php } ?>	
										<?php
										if(isset($_POST['id_expedidora'])){
											$id_expedidora_excluir = $_POST['id_expedidora'];
										if(isset($_POST['excluir'])) {		
											$excluir = "UPDATE ies_expedidoras SET excluido = 'Sim' WHERE id_expedidora = '$id_expedidora_excluir'";
											$executa_exclusao_expedidoras = mysqli_query($con, $excluir);
											} 	
											if($executa_exclusao_expedidoras){
													echo "<meta http-equiv='refresh' content='0, url=exp_reg.php'";
												}    
											}
										?>	
										</tbody>
									</table>
								</div>
							</div>
						<!-- inicio modal de editar expedidora-->
						<div class="modal fade" id="editarexpedidora" tabindex="-1" role="dialog" aria-labelledby="editarexpedidora" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="editarexpedidora">Editar expedidora</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="class/edit-expedidoras.php" enctype="multipart/form-data">
												<!-- nome expedidora -->
												<div class="form-group">
													<label for="nomeexpedidora" class="control-label">Nome Expedidora:</label>
													<input name="nomeexpedidora" type="text" class="form-control" id="nomeexpedidora" required>
												</div>
												<!-- codigo emec expedidora -->
												<div class="form-group">
													<label for="codigoemecexpedidora" class="control-label">Código EMEC Expedidora:</label>
													<input name="codigoemecexpedidora" type="text" class="form-control" id="codigoemecexpedidora" required>
												</div>
												<!-- status expedidora -->
												<div class="form-group">
													<label for="status_expedidora">Status Expedidora</label>
													<select class="form-control" name="status_expedidora" id="status_expedidora" required>
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
							<!-- fim modal de editar expedidora -->	
							<!-- END TABLE STRIPED -->
						</div>
						<div class="col-md-6">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cadastro_registradora">Novo cadastro de registradora</button>
						<!-- inicio modal de adicionar registradora-->
						<div class="modal fade" id="Cadastro_registradora" tabindex="-1" role="dialog" aria-labelledby="Cadastro_registradora" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="TituloModalCentralizado">Cadastro de registradora</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" action="class/insert-registradora.php">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Nome Registradora</label>
									<input type="text" class="form-control" name="nome_registradora" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Código EMEC registradora</label>
									<input type="text" class="form-control" name="codigo_emec_registradora" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<input type="submit" value="cadastrar registradora" button type="button" class="btn btn-primary"></button>
								</form>
							</div>
							</div>
						</div>
						</div>
						<!-- fim modal de adicionar registradora -->
						<p>
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Registradoras</h3>
								</div>
								<div class="panel-body">
								<table class="table table-hover">
										<thead>
											<tr>
												<th>Nome registradora</th>
												<th>Código EMEC registradora</th>
												<th>Status registradora</th>
												<th>Opções</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$lista_registradoras = "SELECT * FROM `ies_registradoras` WHERE `excluido`='Nao' ";
										$mostrar_lista_registradoras = mysqli_query($con, $lista_registradoras);

										while ($row = mysqli_fetch_array($mostrar_lista_registradoras)){ 
											$id_registradora = $row['id_registradora']

											?>
											<tr> 
												<td><?php echo $row['nome_registradora'] ?></td>
												<td><?php echo $row['codigo_emec_registradora'] ?></td>
												<td><?php echo $row['status_registradora'] ?></td>
												<td>
												<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editaregistradora" 
												data-whateverid="<?php echo $row['id_registradora']; ?>" 
												data-whatevernomeregistradora="<?php echo $row['nome_registradora']; ?>"
												data-whatevercodigoemecregistradora="<?php echo $row['codigo_emec_registradora']; ?>">Editar</button>
												</td>
												<form method="post">
												<input type="hidden" name="id_registradora" value="<?php echo $row['id_registradora'] ?>">
												<td><button type="submit" name="excluir" id="excluir" value="excluir" class="btn btn-xs btn-danger">Excluir</button></td>
											</form>
											</tr>
											<?php } ?>
											<?php
										if(isset($_POST['id_registradora'])){
											$id_registradora_excluir = $_POST['id_registradora'];
										if(isset($_POST['excluir'])) {					
											$excluir = "UPDATE ies_registradoras SET excluido = 'Sim' WHERE id_registradora = '$id_registradora_excluir'";
											$executa_exclusao_registradoras = mysqli_query($con, $excluir);
											} 	
											if($executa_exclusao_registradoras){
													echo "<meta http-equiv='refresh' content='0, url=exp_reg.php'";
												}    
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- inicio modal de editar registradora-->
							<div class="modal fade" id="editaregistradora" tabindex="-1" role="dialog" aria-labelledby="editaregistradora" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="editarregistradora">Editar Registradora</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="class/edit-registradoras.php" enctype="multipart/form-data">
												<!-- nome expedidora -->
												<div class="form-group">
													<label for="nomeregistradora" class="control-label">Nome Registradora:</label>
													<input name="nomeregistradora" type="text" class="form-control" id="nomeregistradora" required>
												</div>
												<!-- codigo emec expedidora -->
												<div class="form-group">
													<label for="codigoemecregistradora" class="control-label">Codigo EMEC Registradora:</label>
													<input name="codigoemecregistradora" type="text" class="form-control" id="codigoemecregistradora" required>
												</div>
												<!-- status expedidora -->
												<div class="form-group">
													<label for="status_registradora">Status Expedidora</label>
													<select class="form-control" name="status_registradora" id="status_registradora" required>
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
							<!-- fim modal de editar registradora -->
							<!-- END TABLE HOVER -->
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
				<p class="copyright"><a href="" target="_blank">Faculdade</a>| Desenvolvido por </p>
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
		$('#editarexpedidora').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var recipient = button.data('whateverid') 
		  var recipientnomeexpedidora = button.data('whatevernomeexpedidora')
		  var recipientcodigoemecexpedidora = button.data('whatevercodigoemecexpedidora')

		  var modal = $(this)

		  modal.find('.modal-title').text('Editar Expedidora - ' + recipientnomeexpedidora)
		  modal.find('#id').val(recipient)
		  modal.find('#nomeexpedidora').val(recipientnomeexpedidora)
		  modal.find('#codigoemecexpedidora').val(recipientcodigoemecexpedidora)	  
		})
</script>


<script type="text/javascript">
		$('#editaregistradora').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var recipient = button.data('whateverid') 
		  var recipientnomeregistradora = button.data('whatevernomeregistradora')
		  var recipientcodigoemecregistradora = button.data('whatevercodigoemecregistradora')

		  var modal = $(this)
		  modal.find('.modal-title').text('Editar Registradora - ' + recipientnomeregistradora)
		  modal.find('#id').val(recipient)
		  modal.find('#nomeregistradora').val(recipientnomeregistradora)
		  modal.find('#codigoemecregistradora').val(recipientcodigoemecregistradora)
		})
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
