<?php
    $servername='';
    $username='';
    $password='';
    $databasename='';

    $con = mysql_connect($servername,$username,$password) or die("Não foi possível conectar com o servidor de dados!");
    mysql_select_db($databasename, $con) or die("Banco de dados não localizado.");

    mysql_set_charset('utf8',$con);
?>