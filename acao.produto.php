<?php

    require_once('inc.connect.php');
	(isset($_POST['nome']) and !empty($_POST['nome'])) ?$nome = $_POST['nome']:$erro = TRUE;
    (isset($_POST['pesagem']) and !empty($_POST['pesagem'])) ?$pesagem = $_POST['pesagem']:$erro = TRUE;
    (isset($_POST['volume']) and !empty($_POST['volume'])) ?$volume = $_POST['volume']:$erro = TRUE;
    (isset($_POST['marca']) and !empty($_POST['marca'])) ?$marca = $_POST['marca']:$erro = TRUE;
    (isset($_POST['custo']) and !empty($_POST['custo'])) ?$custo = $_POST['custo']:$erro = TRUE;
	(isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
	(isset($_REQUEST['id_produto']) and !empty($_REQUEST['id_produto']))? $id_produto = $_REQUEST['id_produto'] : $erro = TRUE;
	(isset($_POST['id_produto']) and !empty($_POST['id_produto']))? $id_produto = $_POST['id_produto'] : $erro = TRUE;
	
	$nome_imagem = $_FILES['imagem']['name'];
	$tmp_nome = $_FILES['imagem']['tmp_name'];
	$data_agora = date("YmdHis");
	$dir = 'img/produtos/';


	switch ($acao) {

		case 'insert':

			if(isset($nome_imagem) and !empty($nome_imagem)){
				move_uploaded_file($tmp_nome, $dir.$nome_imagem);
			}

            $query = 'INSERT INTO produto (nome, tipo_pesagem, peso, marca, custo, imagem) VALUES("'.$nome.'","'.$pesagem.'","'.$volume.'","'.$marca.'","'.$custo.'","'.$nome_imagem.'")';
            $erro = !mysql_query($query, $link);
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':
			

			if(isset($nome_imagem) and !empty($nome_imagem)){
				//salva imagem no diretório
				move_uploaded_file($tmp_nome, $dir.$nome_imagem);
				//setando minha query para alterar no banco
				$query = 'UPDATE produto SET nome ="'.$nome.'", tipo_pesagem = "'.$pesagem.'",peso = "'.$volume.'",marca = "'.$marca.'",custo = "'.$custo.'", imagem = "'.$nome_imagem.'" where id_produto = '.$id_produto;
				//apagando imagem antiga
				$query2 = 'SELECT imagem FROM produto WHERE id_produto='.$id_produto;
				$res = mysql_query($query2, $link);
				$linha = mysql_fetch_assoc($res);
				$imagem_apagar = $linha['imagem'];
				unlink($dir.$imagem_apagar);
				//end apagando imagem antiga

			}else{
				$query = 'UPDATE produto SET nome ="'.$nome.'", tipo_pesagem = "'.$pesagem.'",peso = "'.$volume.'",marca = "'.$marca.'",custo = "'.$custo.'" where id_produto = '.$id_produto;
			}
			
			$erro = !mysql_query($query, $link);


			if($erro){
				$msg='erro';
			}else{
				$msg = 'alterado';
			}
			break;

		case 'delete':

			(isset($_GET['id_produto']) and !empty($_GET['id_produto']))? $id_produto = $_GET['id_produto'] : $erro = TRUE;

			//apagando imagem
			$query2 = 'SELECT imagem FROM produto WHERE id_produto='.$id_produto;
			$res = mysql_query($query2, $link);
			$linha = mysql_fetch_assoc($res);
			$imagem_apagar = $linha['imagem'];
			unlink($dir.$imagem_apagar);
			//end apagando

            $query = 'DELETE FROM produto
                      WHERE id_produto = '.$id_produto;
        
            $res = !mysql_query($query,$link);
            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}
	mysql_close();
	header("location:index.php?pg=produto&msg=".$msg);
?>