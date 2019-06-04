<?php
    require_once('inc.connect.php');

    //(isset($_POST['acao']) and !empty($_POST['acao'])) ?$acao = $_POST['acao']:$erro = TRUE;
    (isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;
    (isset($_POST['id_pedido']) and !empty($_POST['id_pedido']))? $id_pedido = $_POST['id_pedido'] : $erro = TRUE;
    (isset($_POST['id_endereco']) and !empty($_POST['id_endereco']))? $id_endereco = $_POST['id_endereco'] : $erro = TRUE;

    //campos pedido
    (isset($_POST['cliente']) and !empty($_POST['cliente'])) ?$cliente = $_POST['cliente']:$erro = TRUE;
    (isset($_POST['cesta']) and !empty($_POST['cesta'])) ?$cesta = $_POST['cesta']:$erro = TRUE; 
    (isset($_POST['datapedido']) and !empty($_POST['datapedido'])) ?$datapedido = $_POST['datapedido']:$erro = TRUE;
    (isset($_POST['datadesejoentrega']) and !empty($_POST['datadesejoentrega'])) ?$datadesejoentrega = $_POST['datadesejoentrega']:$erro = TRUE;
    (isset($_POST['dataentrega']) and !empty($_POST['dataentrega'])) ?$dataentrega = $_POST['dataentrega']:$erro = TRUE;
    (isset($_POST['horario']) and !empty($_POST['horario'])) ?$horario = $_POST['horario']:$erro = TRUE;
    (isset($_POST['contato']) and !empty($_POST['contato'])) ?$contato = $_POST['contato']:$erro = TRUE;
    (isset($_POST['pagamento']) and !empty($_POST['pagamento'])) ?$pagamento = $_POST['pagamento']:$erro = TRUE;
    (isset($_POST['troco']) and !empty($_POST['troco'])) ?$troco = $_POST['troco']:$erro = TRUE; 
    (isset($_POST['observacoes']) and !empty($_POST['observacoes'])) ?$observacoes = $_POST['observacoes']:$erro = TRUE;
    (isset($_POST['horariodesejo']) and !empty($_POST['horariodesejo'])) ?$horariodesejo = $_POST['horariodesejo']:$erro = TRUE;
    //campos endereço
    (isset($_POST['rua']) and !empty($_POST['rua'])) ?$rua = $_POST['rua']:$erro = TRUE; 
    (isset($_POST['numero']) and !empty($_POST['numero'])) ?$numero = $_POST['numero']:$erro = TRUE;
    (isset($_POST['cep']) and !empty($_POST['cep'])) ?$cep = $_POST['cep']:$erro = TRUE;
    (isset($_POST['bairro']) and !empty($_POST['bairro'])) ?$bairro = $_POST['bairro']:$erro = TRUE;
    (isset($_POST['cidade']) and !empty($_POST['cidade'])) ?$cidade = $_POST['cidade']:$erro = TRUE;
    (isset($_POST['estado']) and !empty($_POST['estado'])) ?$estado = $_POST['estado']:$erro = TRUE;
    (isset($_POST['complemento']) and !empty($_POST['complemento'])) ?$complemento = $_POST['complemento']:$erro = TRUE;

    $valor = 1;
    switch ($acao) {
		case 'insert':

            $query = 'INSERT INTO pedido (id_cliente,id_cesta,data_contato,data_desejada_entrega,
            horario_desejado_entrega,data_entrega,horario_entrega, forma_contato,observacao,forma_pagamento,valor,troco,id_endereco) 
            VALUES("'.$cliente.'","'.$cesta.'","'.$datapedido.'","'.$datadesejoentrega.'","'.$horariodesejo.'",
            "'.$dataentrega.'","'.$horario.'","'.$contato.'","'.$observacoes.'","'.$pagamento.'","'.$valor.'","'.$troco.'",(select (max(id_endereco) + 1) from endereco))';
            
            $res1 = !mysql_query($query, $link);
            
            $query2 = 'INSERT INTO endereco (rua, numero, cep, bairro, cidade, estado, complemento) VALUES
            ("'.$rua.'","'.$numero.'","'.$cep.'","'.$bairro.'","'.$cidade.'","'.$estado.'","'.$complemento.'")';
            
            $res2 = !mysql_query($query2, $link);

            if($res1){
                $msg='erro';
            }elseif($res2){
                $msg='erro';
            }else{
                $msg = 'cadastrado';
            }
            break;

		case 'update':

			$query = 'UPDATE pedido  SET id_cliente ="'.$cliente.'", 
                id_cesta ="'.$cesta.'", 
                data_contato ="'.$datapedido.'", 
                data_desejada_entrega ="'.$datadesejoentrega.'",
                horario_desejado_entrega ="'.$horariodesejo.'" ,
                data_entrega ="'.$dataentrega.'", 
                horario_entrega ="'.$horario.'", 
                forma_contato ="'.$contato.'",
                observacao ="'.$observacoes.'",
                forma_pagamento ="'.$pagamento.'",
                valor ="'.$valor.'",
                troco ="'.$troco.'"
                where id_pedido = '.$id_pedido;
            $res1 = !mysql_query($query, $link);
            echo($query);
            $query2 = 'UPDATE endereco SET rua  ="'.$rua.'", numero  ="'.$numero.'", cep  ="'.$cep.'", bairro  ="'.$bairro.'", cidade  ="'.$cidade.'", estado  ="'.$estado.'", complemento  ="'.$complemento.'" where id_endereco ='.$id_endereco;
            $res2 = !mysql_query($query2, $link);
             echo($query2);

             if($res1){
                $msg='erro';
            }elseif($res2){
                $msg='erro';
            }else{
                $msg = 'alterado';
            }

			break;

		case 'delete':
            (isset($_GET['id_pedido']) and !empty($_GET['id_pedido']))? $id_pedido = $_GET['id_pedido'] : $erro = TRUE;

            $query = 'DELETE FROM pedido
                      WHERE id_pedido = '.$id_pedido;
        
            $res = !mysql_query($query,$link);

            if($res){
                $msg='erro';
            }else{
                $msg = 'deletado';
            }            
			break;
	}
    mysql_close();
    header("location:index.php?pg=pedido&msg=".$msg);
    ?>

