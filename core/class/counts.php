<!--count de codext -->
<?php
    $num_result = mysql_query("SELECT COUNT(id_aluno) as TOTAL from alunos_fames") or exit(mysql_error());
    $row = mysql_fetch_object($num_result);
?>
