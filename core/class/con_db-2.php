<?php 
    $servername='';
    $username='';
    $password='';
    $databasename='';

    $con = mysqli_connect($servername,$username,$password,$databasename);

    mysqli_set_charset( $con, 'utf8');

        if (!$con) {
        die("Falha interna na conexão com o banco de dados" . $conn->connect_error);
    }
?>