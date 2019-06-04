<?php

    require_once('inc.connect.php');

    (isset($_POST['id_cesta']) and !empty($_POST['id_cesta'])) ?$id_cesta = $_POST['id_cesta']:$erro = TRUE;
    (isset($_POST['acao']) and !empty($_POST['acao'])) ?$acao = $_POST['acao']:$erro = TRUE;

    switch ($acao) {

    case 'insert':
    
            $query = 'SELECT * FROM produto';
            $res = mysql_query($query,$link);
            $qtd = mysql_num_rows($res);
  
            echo "<form action='acao.itemcesta.php' method='POST'>"; 
            echo "<input type='hidden' name='acao' value='insert'>";
            echo "<input type='hidden' name='id_cesta' value='".$id_cesta."'>";
            echo "<table class='table table-condensed table striped table-bordered table-hover'>";
            echo "<tr><td colspan='4' align='center'><h4>Inserir Produtos na Cesta</h4></td></tr>";
            echo "<tr><td><h4>Produto</h4></td><td><h4>Peso</h4></td><td><h4>Marca</h4></td><td><h4>Quantidade</h4></td></tr>";
            if($qtd>0){
            while($exibe = mysql_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$exibe["nome"]."</td>";
            echo "<td>".$exibe["peso"].' '.$exibe["tipo_pesagem"]."</td>";
            echo "<td>".$exibe["marca"]."</td>";
            echo "<td><input type='number' name='qtd[".$exibe['id_produto']."]' min='0' size='10'></td></tr>";         
            }
            }else{
              echo '<tr align="center">
				      <td colspan="7">Nenhum registro para listar</td>
				      </tr>';
            }
          
        echo "</table>";
        echo "<input type='submit' name='cadastrar' value='Inserir na cesta' class='btn btn-success'>";
        echo "</form>";
			break;



		case 'update':

			echo("Update");

			break;

		case 'delete':

			echo("delete");

			break;



	}

?>
