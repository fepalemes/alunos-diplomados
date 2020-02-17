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
	<title>Usuários | Registro de diplomas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
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
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="cursos.php" class=""><i class="lnr lnr-list"></i> <span>Cursos</span></a></li>
						<li><a href="exp_reg.php" class=""><i class="lnr lnr-list"></i> <span>Expedidoras e Registradoras</span></a></li>
						<li><a href="alunos.php" class=""><i class="lnr lnr-graduation-hat"></i> <span>Alunos</span></a></li>
						<li><a href="usuarios.php" class="active"><i class="lnr lnr-users"></i> <span>Usuários</span></a></li>
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
					<h3 class="page-title">Usuários</h3>
					<div class="row">
						<div class="col-md-6">	
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cadastro_usuario">Novo cadastro de usuário</button>
						<!-- inicio modal de adicionar usuario-->
						<div class="modal fade" id="Cadastro_usuario" tabindex="-1" role="dialog" aria-labelledby="Cadastro_usuario" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="TituloModalCentralizado">Cadastro de usuário</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form method="post" action="class/insert-usuarios.php">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Nome usuário</label>				
									<input type="text" class="form-control" name="nome_usuario" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">E-mail usuário</label>
									<input type="text" class="form-control" name="email_usuario" required>
								</div>
								<div class="form-group">
								<label for="recipient-name" class="col-form-label">Senha usuário</label>
									<input type="password" class="form-control" name="senha_usuario" required>
								</div>
								<div class="form-group">
								<label for="status_aluno">Nível usuário</label>
									<select class="form-control" name="nivel_usuario" id="nivel_usuario" required>
										<option selected value="Operador">Operador</option>
										<option value="Administrador">Administrador</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<input type="submit" value="cadastrar usuario" button type="button" class="btn btn-primary"></button>
								</form>
							</div>
							</div>
						</div>
						</div>
						<!-- fim modal de adicionar usuario -->
						<p>
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Usuários</h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Nome usuário</th>
												<th>E-mail usuário</th>
												<th>Nível usuário</th>
                                                <th>Status usuário</th>
												<th>Opções</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$lista_usuarios = "SELECT * FROM `usuarios_fames` WHERE `excluido`='Nao' ";
										$mostrar_lista_usuarios = mysqli_query($con, $lista_usuarios);
										while ($row = mysqli_fetch_array($mostrar_lista_usuarios)) {
											
											$id_usuario = $row['id_usuario']
										?>
										<tr> 
											<td><?php echo $row['nome_usuario'] ?></td>
											<td><?php echo $row['email_usuario'] ?></td>
											<td><?php echo $row['nivel_usuario'] ?></td>
                                            <td><?php echo $row['status_usuario'] ?></td>
											<td>
											<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editarusuario" 
											data-whateverid="<?php echo $row['id_usuario']; ?>" 
											data-whatevernomeusuario="<?php echo $row['nome_usuario']; ?>"
											data-whateveremailusuario="<?php echo $row['email_usuario']; ?>">Editar</button>
											</td>
											<td>
											<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#alterasenhausuario"
											data-whateverid="<?php echo $row['id_usuario']; ?>" 
											data-whatevernomeusuario="<?php echo $row['nome_usuario']; ?>">Alterar senha</button>
											</td>
											<form method="post">
											<input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario'] ?>">
												<td><button type="submit" name="excluir" id="excluir" value="excluir" class="btn btn-xs btn-danger">Excluir</button></td>
											</form>
										</tr>
										<?php } ?>
										<?php
										if(isset($_POST['id_usuario'])){
											$id_usuario_excluir = $_POST['id_usuario'];

										if(isset($_POST['excluir'])) {		
											
											$excluir = "UPDATE usuarios_fames SET excluido = 'Sim' WHERE id_usuario = '$id_usuario_excluir'";

											$executa_exclusao_usuario = mysqli_query($con, $excluir);
											} 	
											if($executa_exclusao_usuario){
											
													echo "<meta http-equiv='refresh' content='0, url=usuarios.php'";
												}    
											
											}
										?>	
										</tbody>
									</table>
								</div>
							</div>
						<!-- inicio modal de editar usuario-->
						<div class="modal fade" id="editarusuario" tabindex="-1" role="dialog" aria-labelledby="editarusuario" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="editarusuario">Editar usuário</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="class/edit-usuarios.php" enctype="multipart/form-data">
												<!-- nome usuario -->
												<div class="form-group">
													<label for="nomeusuario" class="control-label">Nome usuário:</label>
													<input name="nomeusuario" type="text" class="form-control" id="nomeusuario" required>
												</div>
												<!-- email usuario -->
												<div class="form-group">
													<label for="emailusuario" class="control-label">E-mail usuário</label>
													<input name="emailusuario" type="text" class="form-control" id="emailusuario" required>
												</div>											
												<!-- nivel usuario -->
												<div class="form-group">
													<label for="nivelusuario">Nível usuário</label>
													<select class="form-control" name="nivelusuario" id="nivelusuario" required>
													<option selected value="Operador">Operador</option>
													<option value="Administrador">Administrador</option>
													</select>
												</div>
												<!-- status usuario -->
												<div class="form-group">
													<label for="nivelusuario">Status usuário</label>
													<select class="form-control" name="statususuario" id="statususuario" required>
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
						<!-- fim modal de editar usuario -->	
						<!-- inicio modal de ajustar senha-->
							<div class="modal fade" id="alterasenhausuario" tabindex="-1" role="dialog" aria-labelledby="alterasenhausuario" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="alterasenhausuario">Alterar senha do usuário</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="class/edit-senha-usuarios.php" enctype="multipart/form-data">
												<!-- senha usuario -->
												<div class="form-group">
													<label for="senhausuario" class="control-label">Nova senha do usuário</label>
													<input name="senhausuario" type="password" class="form-control" id="senhausuario" required>
												</div>
												<!-- submit do modal de alteração de senha -->
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
							<!-- fim modal de ajustar senha -->			
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
		$('#editarusuario').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget)
		  var recipient = button.data('whateverid')
		  var recipientnomeusuario = button.data('whatevernomeusuario')
		  var recipientemailusuario = button.data('whateveremailusuario')
		  
		  var modal = $(this)

		  modal.find('.modal-title').text('Editar usuário - ' + recipientnomeusuario)
		  modal.find('#id').val(recipient)
		  modal.find('#nomeusuario').val(recipientnomeusuario)
		  modal.find('#emailusuario').val(recipientemailusuario)
		})
</script>
<script type="text/javascript">
		$('#alterasenhausuario').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget)
		  var recipient = button.data('whateverid')
		  var recipientnomeusuario = button.data('whatevernomeusuario')

		  var modal = $(this)

		  modal.find('.modal-title').text('Alterar senha do usuário - ' + recipientnomeusuario)
		  modal.find('#id').val(recipient)
		  modal.find('#nomeusuario').val(recipientnomeusuario)	 
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