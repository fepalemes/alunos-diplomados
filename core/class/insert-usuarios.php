<?php
include_once 'con_db-2.php';

    $nome_usuario = $_POST['nome_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $senha_usuario_MD5=MD5($senha_usuario);
    $nivel_usuario = $_POST['nivel_usuario'];
    $status_usuario = 'Ativo';
    $status_excluido = 'Nao';

    
    $result_cadastro = "INSERT INTO usuarios_fames 
    (nome_usuario, 
     email_usuario, 
     senha_usuario, 
     nivel_usuario,
     status_usuario, 
     excluido) 
     
     VALUES 
     
     ('$nome_usuario',
     '$email_usuario', 
     '$senha_usuario_MD5', 
     '$nivel_usuario', 
     '$status_usuario', 
     '$status_excluido')";
     
    $resultado_cadastro = mysqli_query($con, $result_cadastro);
    
    if(mysqli_affected_rows($con) != 0){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
                }else{
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }
?>
