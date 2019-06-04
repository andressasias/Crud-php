<?php

    require_once('inc.connect.php');

	(isset($_POST['nome']) and !empty($_POST['nome'])) ?$nome = $_POST['nome']:$erro = TRUE;
    (isset($_POST['valor']) and !empty($_POST['valor'])) ?$valor = $_POST['valor']:$erro = TRUE;
    (isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
    (isset($_POST['id_cesta']) and !empty($_POST['id_cesta']))? $id_cesta = $_POST['id_cesta'] : $erro = TRUE;
	

	switch ($acao) {

		case 'insert':

			$query = 'INSERT INTO cesta (nome, valor) VALUES("'.$nome.'","'.$valor.'")';
			$erro = !mysql_query($query, $link);
            if($erro){
				$msg='erro';
			}else{
				$msg = 'cadastrado';
			}
			break;

		case 'update':
			
			$query = 'UPDATE cesta SET nome ="'.$nome.'", valor = "'.$valor.'" where id_cesta = '.$id_cesta;		
			$erro = !mysql_query($query, $link);
			if($erro){
				$msg='erro';
			}else{
				$msg = 'alterado';
			}

			break;

		case 'delete':
			(isset($_GET['id_cesta']) and !empty($_GET['id_cesta']))? $id_cesta = $_GET['id_cesta'] : $erro = TRUE;

			//excluindo cesta
            $query = 'DELETE FROM cesta
                      WHERE id_cesta = '.$id_cesta;
        
            $res = !mysql_query($query,$link);

            //excluindo itens cadastrados nessa cesta
            $query2 = 'DELETE FROM item_cesta
                      WHERE id_cesta = '.$id_cesta;
            mysql_query($query2,$link);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	
	}

	mysql_close();
	header("location:index.php?pg=cesta&msg=".$msg);

?>