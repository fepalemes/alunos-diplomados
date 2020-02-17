<?php
include_once 'con_db-2.php';

    $nome_curso = $_POST['nome_curso'];
    $codigo_emec_curso = $_POST['codigo_emec_curso'];
    $status_curso_cadastro ='Ativo';
    $status_excluido = 'Nao';
    
    $result_cadastro = "INSERT INTO cursos_fames 
    (nome_curso, 
    codigo_emec_curso, 
    status_curso, 
    excluido)
    
    VALUES 
    
    ('$nome_curso',
     '$codigo_emec_curso', 
     '$status_curso_cadastro', 
     '$status_excluido')";

    $resultado_cadastro = mysqli_query($con, $result_cadastro);
    
    if(mysqli_affected_rows($con) != 0){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
                }else{
                    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }
?>
