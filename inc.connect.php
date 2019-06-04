<?php
	//bibliografia de funções: http://php.net/
	//Declaração de constantes. Sempre declarar com letras maiúsculas para ser mais fácil de encontrar no código. Primeiro é o nome da constante, depois o conteúdo.
/*
	define('DB_SERVIDOR' , 'mysql995.umbler.com');
	define('DB_USUARIO' , 'kitranchoadmin');
	define('DB_SENHA' , 'malonns2');
	define('DB_BANCO' , 'kitrancho');
    */
	define('DB_SERVIDOR' , 'localhost');
	define('DB_USUARIO' , 'root');
	define('DB_SENHA' , '');
	define('DB_BANCO' , 'kitrancho');

	//or, se o que estiver a esquerda der falso, ele executa o que está na direita
	//die mata a execução do programa e escreve a frase
	
	$link = mysql_connect(DB_SERVIDOR, DB_USUARIO, DB_SENHA) or die ('Não foi possível conectar no servidor');

	//selecionar banco para cada variável de conexão (no caso o link)
	mysql_select_db(DB_BANCO, $link) or die('Erro ao conectar no banco de dados');

	//$link = mysqli_connect(DB_SERVIDOR,DB_USUARIO,DB_SENHA,DB_BANCO);
?>