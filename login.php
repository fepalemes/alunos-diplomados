<?php
  ob_start();
  session_start();
  require_once("class/con_db-2.php");
?>
<!doctype html>
<html lang="pt-br" class="fullscreen-bg">

<head>
	<title>Login | Registro de diplomas</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="core/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="core/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="core/assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="core/assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="core/assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="core/assets/img/logo_transparente.png" alt="Klorofil Logo"></div>
								<p class="lead">Faça login para acessar o dashboard</p>
							</div>
							<?php
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $email1=mysqli_real_escape_string($con,$_POST['email']); 
                        $senha1=mysqli_real_escape_string($con,$_POST['senha']); 
                        $senha=MD5($senha1);
 
                        $sql="SELECT * FROM usuarios_fames WHERE email_usuario='$email1' and senha_usuario='$senha'";
                        $result=mysqli_query($con,$sql);
                        $row=mysqli_fetch_array($result);
                        $_SESSION['id_usuario']=$row['id_usuario'];
                        $_SESSION['status_usuario']=$row['status_usuario'];
                        $count=mysqli_num_rows($result);
                        if($count==1){
	                          if ($row['status_usuario']=="Ativo"){ 
                                header ("location: core/index.php");
		                        }
			                      else if ($row['status_usuario']=="Inativo"){ 
                                $_SESSION['status_usuario']=$row['status_usuario'];
                                $error1="Desculpe, seu usuário foi desativado";
                            }
                        }
	                       else{
                            $error2="E-mail ou senha inválida.";
                        }
                     }
                ?>
							<form class="form-auth-small" method="post">
							<span class="text-danger">
                    <u>
                        <h4> 
                            <?php echo $error1, $error2 ?>
                        </h4>
                    </u> 
                </span>
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">E-mail</label>
									<input type="email" class="form-control" required name="email" id="email" placeholder="E-mail">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Senha</label>
									<input type="password" class="form-control" required name="senha" id="senha" placeholder="Senha">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
								<div class="bottom">
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Registro de diplomas</h1>
							<p>Faculdade</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>