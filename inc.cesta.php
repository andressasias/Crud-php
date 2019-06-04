<?php
	$acao='insert';

	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_cesta = $_REQUEST['id_update'] ;
	}else{
		$id_cesta = 0;
	}

	$nome = '';
   	$valor = '';
   	
	if ($id_cesta > 0) {

		$acao='update';
		$query='SELECT nome, valor
							FROM cesta
							where id_cesta ='.$id_cesta;
		$res = mysql_query($query,$link);
	   	$rows=mysql_num_rows($res);
	   	if ($rows > 0) {

		 $linha = mysql_fetch_assoc($res);
		 $nome = $linha['nome'];
		 $valor = $linha['valor'];
	   }   
	 }

	if($acao=='insert'){
		$valor_botao = 'Cadastrar';
	}else if($acao=='update'){
	   $valor_botao = 'Alterar';
	}

echo '
<form action="acao.cesta.php" method="POST">
  
	<table class=" table table-condensed table striped table-bordered table-hover" border="0" 	>
		<input type="hidden" name="acao" value="'.$acao.'">
		<input type="hidden" name="id_cesta" value="'.$id_cesta.'">
		<tr>
			<td colspan="2" align="center"><h4>'.$valor_botao.' Cesta</h4></td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="nome" value="'.$nome.'" size="30"></td>
		</tr>
		<tr>
			<td>Valor:</td>
			<td><input type="text" name="valor" value="'.$valor.'" size="30"></td>
		</tr>
	</table>
	<input type="submit" name="cadastrar" value="'.$valor_botao.' Cesta" class="btn btn-success">
</form>';

?>
<hr>


<table class="table table-condensed table striped table-bordered table-hover" border="1px">
		<tr>
			<td colspan="3" align="center"><h4>Cestas Cadastradas</h4></td>
		</tr>
		<tr align="center">
			<td>Nome</td>
			<td>Valor</td>
			<td>Ações</td>
		</tr>

		<?php
			$query= 'SELECT id_cesta, nome, valor
					FROM cesta
					ORDER BY nome';

			$res = mysql_query($query,$link);
			$qtd = mysql_num_rows($res);

			if($qtd>0){
				while($linha = mysql_fetch_assoc($res)){
					echo '<tr>';
						echo '<td>'.$linha['nome'].'</td>';
						echo '<td>'.$linha['valor'].'</td>';
						echo '<td>
			    <a href="index.php?pg=cesta&id_update='.$linha['id_cesta'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
			    <a href="acao.cesta.php?acao=delete&id_cesta='.$linha['id_cesta'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a>';
			    echo '<form action="index.php?pg=itemcesta" method="POST">
				<input type="hidden" name="acao" value="insert">
				<input type="hidden" name="id_cesta" value="'.$linha['id_cesta'].'">
				<input type="submit" name="cadastrar" value="Inserir Produtos" class="btn btn-success">
				</form>';
				echo '<form action="index.php?pg=itemcesta" method="POST">
				<input type="hidden" name="acao" value="delete">
				<input type="hidden" name="id_cesta" value="'.$linha['id_cesta'].'">
				<input type="submit" name="deletar" value="Deletar Produtos" class="btn btn-danger">
				</form>';
				echo '</tr>';
				}
			}else{
				echo '<tr align="center">
				<td colspan="3">Nenhum registro para listar</td>
				</tr>';
			}
		?>

	</table>

		