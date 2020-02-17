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
	<title>Dashboard | Registro de diplomas</title>
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
						<li><a href="index.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="cursos.php" class=""><i class="lnr lnr-list"></i> <span>Cursos</span></a></li>
						<li><a href="exp_reg.php" class=""><i class="lnr lnr-list"></i> <span>Expedidoras e Registradoras</span></a></li>
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
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Informações</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-graduation-cap"></i></span>
										<p>
											<?php
												$count = "SELECT (id_aluno) FROM alunos_fames WHERE status_aluno = 'ativo' AND excluido = 'Nao'";
												$resultado = mysqli_query($con, $count);
												$soma_alunos = mysqli_num_rows($resultado);   
											{ ?>
											<span class="number"><?php echo $soma_alunos; ?></span>
											<?php } ?>
											<span class="title">Alunos diplomados ativos</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-university"></i></span>
										<p>
										<?php
											$count = "SELECT (id_expedidora) FROM ies_expedidoras WHERE status_expedidora = 'ativo' AND excluido = 'Nao'";
											$resultado = mysqli_query($con, $count);
											$soma_expedidoras = mysqli_num_rows($resultado);   
												{ ?>
											<span class="number"><?php echo $soma_expedidoras; ?></span>
											<?php } ?>
											<span class="title">Expedidoras ativas</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-university"></i></span>
										<p>
										<?php
												$count = "SELECT (id_registradora) FROM ies_registradoras where status_registradora = 'ativo' AND excluido = 'Nao'";
												$resultado = mysqli_query($con, $count);
												$soma_registradoras = mysqli_num_rows($resultado);   
											{ ?>
											<span class="number"><?php echo $soma_registradoras; ?></span>
											<?php } ?>
											<span class="title">Registradoras ativas</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Últimos 5 alunos diplomados</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								
								<div class="panel-body no-padding">
									
								<table id="tabela_alunos" class="table table-hover">
										<thead>
											<tr>
												<th>Nome Aluno</th>
												<th>CPF</th>
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
										
										$lista_alunos = "SELECT * FROM alunos_fames = AF
															
															INNER JOIN cursos_fames = CF
															ON AF.id_curso_aluno = CF.id_curso
															
															INNER JOIN ies_expedidoras = IES_exp
															ON AF.id_expedidora = IES_exp.id_expedidora 

															INNER JOIN ies_registradoras = IES_reg
															ON AF.id_registradora = IES_reg.id_registradora 

															WHERE AF.excluido = 'Nao'

															order by id_aluno desc limit 5";

										$mostrar_lista_alunos = mysqli_query($con, $lista_alunos);
										while ($row = mysqli_fetch_array($mostrar_lista_alunos)) { ?>				 
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
										<?php }	
										?>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6 text-right" align="right"><a href="alunos.php" class="btn btn-primary">Ver todos os alunos</a></div>
									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div	
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
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
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