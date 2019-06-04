<?php

    require_once('inc.connect.php');

	/*saber o que está chegando nessa página

	print_r($_POST);

	die;*/

	//if simplificado, funciona em uma única linha (ternário)
	//(condição)?(verdadeiro):(falso)
	//testando se está setada com algum conteúdo e se não está vazia, então coloca na variável o valor

	(isset($_POST['nome']) and !empty($_POST['nome'])) ?$nome = $_POST['nome']:$erro = TRUE;
    (isset($_POST['celular']) and !empty($_POST['celular'])) ?$celular = $_POST['celular']:$erro = TRUE;
    (isset($_POST['telefone']) and !empty($_POST['telefone'])) ?$telefone = $_POST['telefone']:$erro = TRUE;
    (isset($_POST['email']) and !empty($_POST['email'])) ?$email = $_POST['email']:$erro = TRUE;
    (isset($_POST['facebook']) and !empty($_POST['facebook'])) ?$facebook = $_POST['facebook']:$erro = TRUE;
	(isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
	(isset($_REQUEST['id_cliente']) and !empty($_REQUEST['id_cliente']))? $id_cliente = $_REQUEST['id_cliente'] : $erro = TRUE;

	$nome_foto = $_FILES['foto']['name'];
	$tmp_nome = $_FILES['foto']['tmp_name'];
	$data_agora = date("YmdHis");
	$dir = 'img/clientes/';
	


	//testa a ação para fazer a query de acordo

	switch ($acao) {

		case 'insert':

			if(isset($nome_foto) and !empty($nome_foto)){
				move_uploaded_file($tmp_nome, $dir.$nome_foto);
			}
			//aspas simples pro php e duplas para sql

			$query = 'INSERT INTO cliente (nome, celular, telefone, email, link_facebook, foto) VALUES("'.$nome.'","'.$celular.'","'.$telefone.'","'.$email.'","'.$facebook.'","'.$nome_foto.'")';

			//echo($query);
			//executa qualquer instrução sql. Vou rodar minha variável $query na conexão ativa $link. 
			// die(mysql_error()) se tiver erro, vai encerrar o programa e apresentar o erro do mysql na tela.
			//defini minha msg como erro antes, se rodar tudo certo no mysql_query muda para cadastrado.
			
            $erro = !mysql_query($query, $link);
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':

			if(isset($nome_foto) and !empty($nome_foto)){
				move_uploaded_file($tmp_nome, $dir.$nome_foto);

				$query = 'UPDATE cliente SET nome ="'.$nome.'", celular = "'.$celular.'",telefone = "'.$telefone.'",email = "'.$email.'",link_facebook = "'.$facebook.'", foto = "'.$nome_foto.'" where id_cliente = '.$id_cliente;

				//apagando imagem antiga
				$query2 = 'SELECT foto FROM cliente WHERE id_cliente='.$id_cliente;
				$res = mysql_query($query2, $link);
				$linha = mysql_fetch_assoc($res);
				$imagem_apagar = $linha['foto'];
				unlink($dir.$imagem_apagar);
				//end apagando imagem antiga

			}else{
				$query = 'UPDATE cliente SET nome ="'.$nome.'", celular = "'.$celular.'",telefone = "'.$telefone.'",email = "'.$email.'",link_facebook = "'.$facebook.'" where id_cliente = '.$id_cliente;
			}
			
			$erro = !mysql_query($query, $link);
			if($erro){
				$msg='erro';
			}else{
				$msg = 'alterado';
			}
			break;

		case 'delete':
			(isset($_GET['id_cliente']) and !empty($_GET['id_cliente']))? $id_cliente = $_GET['id_cliente'] : $erro = TRUE;

			//apagando imagem 
				$query2 = 'SELECT foto FROM cliente WHERE id_cliente='.$id_cliente;
				$res = mysql_query($query2, $link);
				$linha = mysql_fetch_assoc($res);
				$imagem_apagar = $linha['foto'];
				unlink($dir.$imagem_apagar);
				//end apagando imagem 

            $query = 'DELETE FROM cliente
                      WHERE id_cliente = '.$id_cliente;
        
            $res = !mysql_query($query,$link);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}

	mysql_close();
	header("location:index.php?pg=cliente&msg=".$msg);

?>