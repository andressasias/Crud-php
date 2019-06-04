<?php
	$acao='insert';

	if (isset($_REQUEST['id_update']) and !empty($_REQUEST['id_update'])) {
		$id_produto = $_REQUEST['id_update'] ;
	}else{
		$id_produto = 0;
	}

	$nome = '';
   	$tipo_pesagem = '';
   	$volume = '';
   	$marca = '';
	$custo = '';
	$imagem = '';

	if ($id_produto > 0) {

		$acao='update';
		$query='SELECT nome, tipo_pesagem, peso, marca, custo, imagem
							FROM produto
							where id_produto ='.$id_produto;
		$res = mysql_query($query,$link);
	   	$rows=mysql_num_rows($res);
	   	if ($rows > 0) {

		 $linha = mysql_fetch_assoc($res);
		 $nome = $linha['nome'];
		 $tipo_pesagem = $linha['tipo_pesagem'];
		 $volume = $linha['peso'];
		 $marca = $linha['marca'];
		 $custo = $linha['custo'];
		 $imagem = $linha['imagem'];
	   }   
	 }

	if($acao=='insert'){
		$valor_botao = 'Cadastrar';
	}else if($acao=='update'){
	   $valor_botao = 'Alterar';
	}

	 echo '
	 	 
<form action="acao.produto.php" method="POST" enctype="multipart/form-data">

	<table class="table table-condensed table-striped table-bordered table-hover" border="0">
		<input type="hidden" name="acao" value="'.$acao.'">
		<input type="hidden" name="id_produto" value="'.$id_produto.'">	
		<tr>
			<td colspan="2" align="center"><h4>'.$valor_botao.' Produto</h4></td>
		</tr>
		<tr>
		
			<td>Nome:</td>
			<td><input type="text" name="nome" value="'.$nome.'" size="30"></td>
		</tr>
		<td>Tipo Volume</td>
		<td>';
		
		if($tipo_pesagem == "kilo"){
			echo '<input type="radio" name="pesagem" value="kilo" checked>Kilo
			<input type="radio" name="pesagem" value="gramas">Gramas
			<input type="radio" name="pesagem" value="litro">Litro
			<input type="radio" name="pesagem" value="ml">ml';
		}elseif($tipo_pesagem == "gramas"){
			echo '<input type="radio" name="pesagem" value="kilo">Kilo
			<input type="radio" name="pesagem" value="gramas" checked>Gramas
			<input type="radio" name="pesagem" value="litro">Litro
			<input type="radio" name="pesagem" value="ml">ml';
		}elseif($tipo_pesagem == "litro"){
			echo '<input type="radio" name="pesagem" value="kilo">Kilo
			<input type="radio" name="pesagem" value="gramas" >Gramas
			<input type="radio" name="pesagem" value="litro" checked>Litro
			<input type="radio" name="pesagem" value="ml">ml';
		}
		else{
			echo '<input type="radio" name="pesagem" value="kilo">Kilo
			<input type="radio" name="pesagem" value="gramas" >Gramas
			<input type="radio" name="pesagem" value="litro">Litro
			<input type="radio" name="pesagem" value="ml" checked>ml';
		}
		echo '</td>
		<tr>
		<tr>
			<td>Volume</td>
			<td><input type="text" name="volume" value="'.$volume.'" size="30"></td>
		</tr>	
		<tr>
			<td>Marca</td>
			<td><input type="text" name="marca" value="'.$marca.'" size="30"></td>
		</tr>
		<tr>
			<td>Custo</td>
			<td><input type="text" name="custo" value="'.$custo.'" size="30"></td>
		</tr>
		<tr>
			<td>Imagem</td><td>';
			if($acao=='update'){
				if($imagem==NULL){
					echo '<img id="imagem_produto" src="img/produtos/no-image.png" width=5%>';
				}else{
					echo '<img id="imagem_produto" src="img/produtos/'.$imagem.'" width=10%>';
				}
				
			}
			echo '<input type="file" name="imagem"></td>';
			

		echo '</tr>
		<tr>
			<td colspan="2" align="left">
				<input type="submit" name="cadastrar" value="'.$valor_botao.' Produto" class="btn btn-success">
			</td>

		</tr>
	</table>
</form>
';
?>
<hr>

<table class="table table-condensed table-striped table-bordered table-hover" border="1px">

	<tr>

		<td colspan="6" align="center">
			<h4>Produtos Cadastrados</h4>
		</td>

	</tr>

	<tr align="center">

		<td>Imagem</td>
		<td>Nome</td>

		<td>Tipo Volume</td>

		<td>Volume</td>

		<td>Marca</td>

		<td>Custo</td>

		<td>Ações</td>

	</tr>

	<tr>
		<?php
			$query='SELECT * FROM produto ORDER BY nome';
			$res = mysql_query($query,$link);
			$qtd = mysql_num_rows($res);

			if($qtd>0){

				while($linha = mysql_fetch_assoc($res)){
				echo '<tr>';
				if($linha['imagem']==NULL){
					echo '<td><img id="imagem_produto" src="img/produtos/no-image.png" width=5%> </td>';
				}else{
					echo '<td><img id="imagem_produto" src="img/produtos/'.$linha['imagem'].'" width=5%> </td>';
				}
				
				echo '<td>'.$linha['nome'].'</td>';
				echo '<td>'.$linha['tipo_pesagem'].'</td>';
				echo '<td>'.$linha['peso'].'</td>';
				echo '<td>'.$linha['marca'].'</td>';
				echo '<td>'.$linha['custo'].'</td>';
				
				echo '<td><a href="index.php?pg=produto&id_update='.$linha['id_produto'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
				<a href="acao.produto.php?acao=delete&id_produto='.$linha['id_produto'].'" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></td>';
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