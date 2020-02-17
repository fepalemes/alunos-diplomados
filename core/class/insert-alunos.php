<?php
include_once 'con_db-2.php';

    $nome_aluno = $_POST['nome_aluno'];
    $cpf_aluno = $_POST['cpf_aluno'];
    $cpf_digitos_aluno = $_POST['cpf_digitos_aluno'];
    $curso_aluno = $_POST['curso_aluno'];
    $expedidora_aluno = $_POST['expedidora_aluno'];
    $registradora_aluno = $_POST['registradora_aluno'];
    $dt_ingresso = $_POST['dt_ingresso'];
    $dt_conclusao = $_POST['dt_conclusao'];
    $dt_expedicao_diploma = $_POST['dt_expedicao_diploma'];
    $dt_registro_diploma = $_POST['dt_registro_diploma'];
    $num_expedicao = $_POST['num_expedicao'];
    $num_registro = $_POST['num_registro'];
    $dt_registro_dou = $_POST['dt_registro_dou'];
    $status_aluno ='Ativo';
    $excluido = 'Nao';
    
    $result_cadastro = "INSERT INTO alunos_fames 
    (nome_aluno, 
    cpf, 
    digitos_cpf, 
    id_curso_aluno, 
    id_expedidora, 
    id_registradora, 
    data_ingresso_curso, 
    data_conclusao_curso,
    data_expedicao_curso, 
    data_registro_diploma, 
    id_num_expedicao, 
    id_num_registro, 
    data_registro_dou, 
    status_aluno,
    excluido) 
    
    VALUES 
    
    ('$nome_aluno',
    '$cpf_aluno', 
    '$cpf_digitos_aluno', 
    '$curso_aluno',
    '$expedidora_aluno', 
    '$registradora_aluno',
    '$dt_ingresso',
    '$dt_conclusao',
    '$dt_expedicao_diploma', 
    '$dt_registro_diploma', 
    '$num_expedicao',
    '$num_registro',
    '$dt_registro_dou',
    '$status_aluno',
    '$excluido')";

    $resultado_cadastro = mysqli_query($con, $result_cadastro);
    
    if(mysqli_affected_rows($con) != 0){
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }else{
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=URLDESEJADA'>";    
            }
?>