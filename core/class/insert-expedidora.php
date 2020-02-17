<?php
include_once 'con_db-2.php';

    $nome_expedidora = $_POST['nome_expedidora'];
    $codigo_emec_expedidora = $_POST['codigo_emec_expedidora'];
    $status_expedidora_cadastro ='Ativo';
    $status_excluido = 'Nao';
    
    $result_cadastro = "INSERT INTO ies_expedidoras 
    (nome_expedidora, 
     codigo_emec_expedidora, 
     status_expedidora, 
     excluido) 
     
     VALUES 
     
     ('$nome_expedidora',
     '$codigo_emec_expedidora',
     '$status_expedidora_cadastro', 
     '$status_excluido')";
     
    $resultado_cadastro = mysqli_query($con, $result_cadastro);
    
    if(mysqli_affected_rows($con) != 0){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
                }else{
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }
?>
