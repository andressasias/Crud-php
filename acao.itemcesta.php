<?php
	require_once('inc.connect.php');
	print_r($_POST);
	(isset($_POST['qtd']) and !empty($_POST['qtd'])) ?$qtd	 = $_POST['qtd']:$erro = TRUE;
	(isset($_POST['acao']) and !empty($_POST['acao'])) ?$acao = $_POST['acao']:$erro = TRUE;
	(isset($_POST['id_cesta']) and !empty($_POST['id_cesta'])) ?$id_cesta = $_POST['id_cesta']:$erro = TRUE;
	switch ($acao) {

		case 'insert':
    		foreach ($qtd as $key => $value) {
				$query = 'INSERT INTO item_cesta (id_produto, quantidade, id_cesta) VALUES("'.$key.'","'.$value.'","'.$id_cesta.'")';
				$res = !mysql_query($query, $link);
			}			
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':
			echo("Update");
			break;

		case 'delete':
			echo("delete");
			break;
	}

	mysql_close();
	header("location:index.php?pg=cesta&msg=".$msg);
?>