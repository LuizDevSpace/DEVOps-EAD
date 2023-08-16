<?php
include "Model.php";
$model = new Model();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Faculdade Impacta Luiz Otávio</title>
</head>
<body>
<h1>Mercadinho da Esquina</h1>
<form method="POST" action="">
    <?php
    $insert = $model->inserir();
    ?>
    <label for="nomeProduto">Nome Produto</label>
    <input type="text" id="nomeProduto" name="nomeProd" required>
    <label for="nomeProduto">Quantidade Produto</label>
    <input type="number" id="quantidadeProduto" name="quantidadeProd" required>
    <label for="categoriaProduto">Categoria do Produto</label>
    <select id="categoriaProd" name="categoriaProd" required>
    <option name="verdura">Verdura</option>
    <option name="fruta">Fruta </option>
    <option name="legume">Legume</option>
    <option name="frios">Frios</option>  
  </select>
    <input type="submit" id="adicionarProduto" name="adicionarProduto" value="Cadastrar Produto">
</form>

<table>
  <tr>
    <th>Nome</th>
    <th>Quantidade</th>
    <th>Categoria</th>
    <th></th>
    <th></th>
  </tr>
<?php 
       $model = new Model();
       $listarProduto = $model->listar();
       
       if(!empty($listarProduto)){
        foreach($listarProduto as $linha){ 
?>

  <tr>
    <td><?php echo $linha['nomeProd']; ?></td>
    <td><?php echo $linha['quantidadeProd']; ?></td>
    <td><?php echo $linha['categoriaProd']; ?></td>
    
  </tr>

<?php
    }
}
?> 
</table>


</body>
</html>



