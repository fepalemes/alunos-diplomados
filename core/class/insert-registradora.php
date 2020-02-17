<?php
include_once 'con_db-2.php';

    $nome_registradora = $_POST['nome_registradora'];
    $codigo_emec_registradora = $_POST['codigo_emec_registradora'];
    $status_registradora_cadastro ='Ativo';
    $status_excluido = 'Nao';
    
    $result_cadastro = "INSERT INTO ies_registradoras 
    (nome_registradora, 
    codigo_emec_registradora, 
    status_registradora, 
    excluido) 
    
    VALUES 
    
    ('$nome_registradora',
    '$codigo_emec_registradora', 
    '$status_registradora_cadastro', 
    '$status_excluido')";

    $resultado_cadastro = mysqli_query($con, $result_cadastro);
    
    if(mysqli_affected_rows($con) != 0){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
                }else{
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }
?>