# alunos-diplomados
Sistema de administração e cadastro de alunos diplomados de ensino superior.

Sistema desenvolvido para atender parte da portaria do MEC N° 1095, onde é necessário que o site da IES apresente os dados dos alunos diplomados.

A consulta é pelo CPF e não retorna as informações dos demais alunos.

Segue instruções para utilizar o sistema:

- Importe o modelo de banco de dados. O script do sql está disponível na pasta sql;
- Aponte as configurações do seu banco de dados nos arquivos con-db 1 e 2 dentro da pasta core/class;
- Ajuste os arquivos de edit e insert dentro da pasta core/class apontando a URL de refresh para cada inclusão ou alteração de informação;
- O arquivo index.php na raiz do projeto serve para a consulta do aluno e embeded no site da IES.
