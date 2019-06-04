<?php

//por default coloco a ação como insert
$acao='insert';

//testo se recebi um id de update, se sim a minha variável $id_cliente vai receber o id, se não a variável id_cliente recebe zero.
	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_cliente = $_REQUEST['id_update'] ;
	}else{
		$id_cliente = 0;
	}

	//zerando as variáveis, caso não seja update não aparece nada nos inputs
	$nome = '';
   	$celular = '';
   	$telefone = '';
   	$email = '';
	$link_facebook = '';
	$foto = '';

	//testo se o meu id_cliente é maior que zero, se sim significa que estou alterando, então tenho que puxar os dados do banco para colocar nos inputs
	if ($id_cliente > 0) {

		//troco a ação para update
		$acao='update';

		$query='SELECT nome, celular, telefone, email, link_facebook, foto
							FROM cliente
							where id_cliente ='.$id_cliente;
			$res = mysql_query($query,$link);

		
	   $rows=mysql_num_rows($res);

	   if ($rows > 0) {

		 $linha = mysql_fetch_assoc($res);
		 $nome = $linha['nome'];
		 $celular = $linha['celular'];
		 $telefone = $linha['telefone'];
		 $email = $linha['email'];
		$link_facebook = $linha['link_facebook'];
		$foto = $linha['foto'];

		  
	   }   
	 }

	 //arrumando variável para eu mostrar no meu botão e como título da página

	 if($acao=='insert'){
		 $valor_botao = 'Cadastrar';
	 }else if($acao=='update'){
		$valor_botao = 'Alterar';
	 }
	 
	//iniciando meu form
	

	echo '<form action="acao.cliente.php" method="POST" enctype="multipart/form-data">
	<table class="table table-condensed table-striped table-bordered table-hover">
	<input type="hidden" name="acao" value="'.$acao.'">
	<input type="hidden" name="id_cliente" value="'.$id_cliente.'">	
	<tr>
		<td colspan="2" align="center"><h4>'.$valor_botao.' Cliente</h4></td>
	</tr>
	<tr>
		<td>Nome:</td>
		<td><input type="text" name="nome" value="'.$nome.'" size="30"></td>
	</tr>
		<tr>
			<td>Celular:</td>
			<td><input type="text" name="celular" value="'.$celular.'" size="30"></td>
		</tr>
		
		<tr>
			<td>Telefone:</td>
			<td><input type="text" name="telefone" value="'.$telefone.'"  size="30"></td>
		</tr>

		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value="'.$email.'" size="30"></td>
		</tr>

		<tr>
			<td>Link Facebook:</td>
			<td><input type="text" name="facebook" value="'.$link_facebook.'" size="30"></td>
		</tr>

		<tr>
			<td>Foto</td><td>';
			if($acao=='update'){
				if($foto==NULL){
					echo '<img id="imagem_cliente" src="img/clientes/no-image.png" width=5%>';
				}else{
					echo '<img id="imagem_cliente" src="img/clientes/'.$foto.'" width=10%>';
				}
				
			}
			echo '<input type="file" name="foto"></td>';
			

		echo '</tr>
	</table>

	<input type="submit" name="cadastrar" class="btn btn-success" value="'.$valor_botao.' Cliente">

</form>';

?>
<hr>

<!--Lista de clientes-->

<table class=" table table-condensed table striped table-bordered table-hover"border="1px">

		<tr>

			<td colspan="7" align="center"><h4>Clientes Cadastrados</h4></td>

		</tr>

		<tr align="center">

			<td>Imagem</td>

			<td>Nome</td>

			<td>Celular</td>

			<td>Telefone</td>

			<td>Email</td>

			<td>Link Facebook</td>

			<td>Ações</td>

		</tr>
		<?php
			$query='SELECT id_cliente, nome, celular, telefone, email, link_facebook, foto
							FROM cliente
							ORDER BY nome';
			$res = mysql_query($query,$link);

			//quantas linhas eu tenho de respodta da minha consulta
			$qtd = mysql_num_rows($res);

			if($qtd>0){

				//enquanto eu conseguir fazer atribuições da minha função para $linha, eu tenho registros para listas
				//mysql_fetch_assoc devolve um array associativo
				while($linha = mysql_fetch_assoc($res)){
					echo '<tr>';
					if($linha['foto']==NULL){
						echo '<td><img id="imagem_cliente" src="img/clientes/no-image.png" width=5%> </td>';
					}else{
						echo '<td><img id="imagem_cliente" src="img/clientes/'.$linha['foto'].'" width=5%> </td>';
					}
					echo '<td>'.$linha['nome'].'</td>';
					echo '<td>'.$linha['celular'].'</td>';
					echo '<td>'.$linha['telefone'].'</td>';
					echo '<td>'.$linha['email'].'</td>';
					echo '<td>'.$linha['link_facebook'].'</td>';
					echo '<td><a href="index.php?pg=cliente&id_update='.$linha['id_cliente'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
					<a href="acao.cliente.php?acao=delete&id_cliente='.$linha['id_cliente'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></td>';
					echo '</tr>';

				}

			}else{
				echo '<tr align="center">
				<td colspan="7">Nenhum registro para listar</td>
				</tr>';
			}



		?>

	</table>

