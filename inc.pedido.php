<?php require_once('inc.connect.php'); 
	$acao='insert';
	
	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_pedido = $_REQUEST['id_update'] ;
	}else{
		$id_pedido = 0;
	}

	$data_contato = '';
	$data_desejada_entrega = '';
	$horario_desejado_entrega='';
	$data_entrega = '';
	$horario_entrega = '';
	$forma_contato = '';
	$observacao = '';
	$forma_pagamento = '';
	$valor = '';
	$troco = '';
	$id_cliente = '';
	$id_cesta = '';
	$id_endereco = '';
	$rua = '';
	$numero = '';
	$cep = '';
	$bairro = '';
	$cidade = '';
	$estado = '';
	$complemento = '';

	if ($id_pedido > 0) {

		$acao='update';
		//buscando da tabela pedido
		$query='SELECT id_cliente,id_cesta,data_contato,data_desejada_entrega,
            	horario_desejado_entrega,data_entrega,horario_entrega,forma_contato,observacao,forma_pagamento,valor,troco,id_endereco
							FROM pedido
							where id_pedido ='.$id_pedido;
		$res = mysql_query($query,$link);
	   	$rows=mysql_num_rows($res);
	   	if ($rows > 0) {

		$linha = mysql_fetch_assoc($res);
		$id_cliente = $linha['id_cliente'];
		$id_cesta = $linha['id_cesta'];
		$data_contato = $linha['data_contato'];
		$data_desejada_entrega = $linha['data_desejada_entrega'];
		$horario_desejado_entrega=$linha['horario_desejado_entrega'];
		$data_entrega = $linha['data_entrega'];
		$horario_entrega = $linha['horario_entrega'];
		$forma_contato = $linha['forma_contato'];
		$observacao = $linha['observacao'];
		$forma_pagamento = $linha['forma_pagamento'];
		$valor = $linha['valor'];
		$troco = $linha['troco'];		
		$id_endereco = $linha['id_endereco'];
	   }

	   //buscando da tabela endereco
	   $query2 = 'SELECT rua, numero, cep, bairro, cidade, estado, complemento
	   				FROM endereco
	   				where id_endereco ='.$id_endereco;

	   	$res = mysql_query($query2,$link);
	   	$rows2=mysql_num_rows($res);

	   	if ($rows2 > 0) {
	   		$linha = mysql_fetch_assoc($res);
	   		$rua = $linha['rua'];
			$numero = $linha['numero'];
			$cep = $linha['cep'];
			$bairro = $linha['bairro'];
			$cidade = $linha['cidade'];
			$estado = $linha['estado'];
			$complemento = $linha['complemento'];
	   	}

	 }

	if($acao=='insert'){
		$valor_botao = 'Cadastrar';
	}else if($acao=='update'){
	   $valor_botao = 'Alterar';
	}

?>
<form action="acao.pedido.php" method="POST">
	
	<table class="table table-condensed table-striped table-bordered table-hover">

		<?php
		echo '<input type="hidden" name="acao" value="'.$acao.'">
		<input type="hidden" name="id_pedido" value="'.$id_pedido.'">
		<input type="hidden" name="id_endereco" value="'.$id_endereco.'">
		<tr><td colspan="2" align="center"><h4>'.$valor_botao.' Pedido</h4></td></tr>';
		?>
		
		<tr>
		<td>Cliente</td>
			<td>			
				<?php	
					$query='SELECT id_cliente, nome FROM cliente';
					$res = mysql_query($query,$link);
					$qtd = mysql_num_rows($res);
					echo '<select name="cliente">';
					echo '<option>Selecione</option>';
					if($qtd>0){
						while($exibe = mysql_fetch_assoc($res)){
							if($exibe['id_cliente']==$id_cliente){
								echo '<option selected value="'.$exibe['id_cliente'].'">'.$exibe['nome'].'</option>'; 
							}else{
								echo '<option value="'.$exibe['id_cliente'].'">'.$exibe['nome'].'</option>'; 
							}
						}
					}else{
						echo '<option>Nenhum cliente cadastrado</option>';
					}
					echo '</select>';
        			?>					
			</td>
		</tr>
		<tr>
			<td>Cesta</td>
            <td>
			<select name="cesta">
				<option>Selecione</option>
				<?php
					$query='SELECT id_cesta,nome,valor FROM cesta';
					$res = mysql_query($query,$link);
					$qtd = mysql_num_rows($res);
					if($qtd>0){
						while($exibe = mysql_fetch_assoc($res)){
							if($exibe['id_cesta']==$id_cesta){
								echo "<option selected value=".$exibe["id_cesta"].">".$exibe["nome"]." valor:".$exibe["valor"]."</option>"; 
							}else{
							echo "<option value=".$exibe["id_cesta"].">".$exibe["nome"]." valor:".$exibe["valor"]."</option>";     
							}
						}
					}else{
						echo '<option>Nenhuma cesta cadastrada</option>';
					}?>					
				</select>
            </td>	
		</tr>
		<tr>
			<td>Data do pedido:</td>
			<td><input type="date" value="<?php echo $data_contato?>" name="datapedido"></td>
		</tr>				
        <tr>
			<td>Data desejada de entrega:</td>
			<td><input type="date" value="<?php echo $data_desejada_entrega?>" name="datadesejoentrega"></td>
		</tr>
		<tr>
			<td>Horário desejado de Entrega</td>
			<td><input type="time" value="<?php echo $horario_desejado_entrega?>" name="horariodesejo" size="30"></td>
		</tr>
        <tr>
			<td>Data de entrega:</td>
			<td><input type="date" value="<?php echo $data_entrega?>" name="dataentrega"></td>
		</tr>
		<tr>
			<td>Horário Entrega</td>
			<td><input type="time" value="<?php echo $horario_entrega?>" name="horario" size="30"></td>
		</tr>
		<tr>
			<td>Forma de contato</td>
			<td>
			<?php
				if($forma_contato=='telefone'){
				echo '<input type="radio" name="contato" value="telefone"checked>Telefone
				<input type="radio" name="contato" value="whats">WhatsApp
				<input type="radio" name="contato" value="face">Facebook';
				}elseif($forma_contato=='whats'){
				echo '<input type="radio" name="contato" value="telefone">Telefone
				<input type="radio" name="contato" value="whats" checked>WhatsApp
				<input type="radio" name="contato" value="face">Facebook';
				}else{
				echo '<input type="radio" name="contato" value="telefone">Telefone
				<input type="radio" name="contato" value="whats">WhatsApp
				<input type="radio" name="contato" value="face" checked>Facebook';
				}
			?>
			</td>				
		</tr>
        <td>Forma de Pagamento</td>
            <td>
            <?php
            	if($forma_pagamento='dinheiro'){
            		echo '<input type="radio" name="pagamento" value="dinheiro" checked>Dinheiro
            	<input type="radio" name="pagamento" value="debito">Débito
            	<input type="radio" name="pagamento" value="credito">Crédito';
            	}elseif($forma_pagamento='debito'){
            	echo '<input type="radio" name="pagamento" value="dinheiro" >Dinheiro
            	<input type="radio" name="pagamento" value="debito" checked>Débito
            	<input type="radio" name="pagamento" value="credito">Crédito';
            	}else{
            		echo '<input type="radio" name="pagamento" value="dinheiro" >Dinheiro
            	<input type="radio" name="pagamento" value="debito" >Débito
            	<input type="radio" name="pagamento" value="credito checked">Crédito';
            	}
            ?>
            </td>
        <tr>
			<td>Troco</td>
			<td><input type="text" value="<?php echo $troco?>" name="troco" size="10"></td>
		</tr>
        <tr>
			<td>Observações</td>
			<td><textarea class="form-control" name="observacoes" rows="5" id="comment"><?php echo $observacao?></textarea></td>				
		</tr>
        <tr>
			<td colspan="2" align="center">Endereço de Entrega</td>
		</tr>
        <tr>
			<td>Rua</td>
			<td><input type="text" value="<?php echo $rua?>" name="rua" size="30"></td>
		</tr>

        <tr>
			<td>Numero</td>
			<td><input type="text" value="<?php echo $numero?>" name="numero" size="10"></td>
		</tr>
        <tr>
			<td>CEP</td>
			<td><input type="text" value="<?php echo $cep?>" name="cep" size="10"></td>
		</tr>
        <tr>
			<td>Bairro</td>
			<td><input type="text" value="<?php echo $bairro?>" name="bairro" size="30"></td>
		</tr>
        <tr>
			<td>Cidade</td>
			<td><input type="text" value="<?php echo $cidade?>" name="cidade" size="30"></td>
		</tr>
        <tr>
			<td>Estado</td>
			<td><input type="text" value="<?php echo $estado?>" name="estado" size="10"></td>
		</tr><tr>
			<td>Complemento</td>
			<td><input type="text" value="<?php echo $complemento?>" name="complemento" size="10"></td>
		</tr>
	</table>
	
			
	<input type="submit" name="cadastrar" value="<?php echo $valor_botao?> Pedido" class="btn btn-success">
</form>
<hr>
<table class="table table-condensed table-striped table-bordered table-hover" border="1px">

		<tr>

			<td colspan="13" align="center"><h4>Pedidos</h4></td>

		</tr>

		<tr align="center">

			<td>Nome Cliente</td>

			<td>Cesta</td>

			<td>Data do pedido</td>

            <td>Data desejada de entrega</td>

            <td>Data de entrega</td>

            <td>Horário Entrega</td>

            <td>Forma de contato</td>

            <td>Forma de Pagamento</td>

            <td>Valor</td>

            <td>Troco</td>

            <td>Observações</td>

            <td>Cidade</td>

			<td>Ações</td>

		</tr>

		<tr>
			<?php
				$query='SELECT * FROM pedido ORDER BY data_contato';
				$res = mysql_query($query,$link);

		
			$qtd = mysql_num_rows($res);

			if($qtd>0){

				while($linha = mysql_fetch_assoc($res)){

					echo '<tr>';
					echo '<td>'.$linha['id_cliente'].'</td>';
					echo '<td>'.$linha['id_cesta'].'</td>';
					echo '<td>'.$linha['data_contato'].'</td>';
					echo '<td>'.$linha['data_desejada_entrega'].'</td>';
					echo '<td>'.$linha['data_entrega'].'</td>';
					echo '<td>'.$linha['horario_entrega'].'</td>';
					echo '<td>'.$linha['forma_contato'].'</td>';
					echo '<td>'.$linha['forma_pagamento'].'</td>';
					echo '<td>'.$linha['valor'].'</td>';
					echo '<td>'.$linha['troco'].'</td>';
					echo '<td>'.$linha['observacao'].'</td>';
					echo '<td>'.$linha['id_endereco'].'</td>';
					echo '<td>
						<a href="index.php?pg=pedido&id_update='.$linha['id_pedido'].'" class="btn btn-primary">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
						</a>
						<a href="acao.pedido.php?acao=delete&id_pedido='.$linha['id_pedido'].'" class="btn btn-danger">
							<span class="glyphicon glyphicon-trash" aria-hidden="true">
						</a>
						</td>';
					echo '</tr>';

				}
			}else{
				echo '<tr align="center">
				<td colspan="7">Nenhum registro para listar</td>
				</tr>';
			}

			?>
		</tr>
			</table>

