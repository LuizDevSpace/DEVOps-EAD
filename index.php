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
<h1>Inserir Produto</h1>
<form method="POST" action="">
    <?php
    $insert = $model->inserir();
    ?>
    <label for="nomeProduto">Nome Produto</label>
    <input type="text" id="nomeProduto" name="nomeProd">
    <label for="nomeProduto">Quantidade Produto</label>
    <input type="number" id="quantidadeProduto" name="quantidadeProd">
    <label for="descricaoProduto">Categoria do Produto</label>
    <input type="text" id="categoriaProduto" name="categoriaProd">
    <input type="submit" id="adicionarProduto" name="adicionarProduto" value="Cadastrar Produto">
</form>

<table>
  <tr>
    <th>Nome</th>
    <th>Quantidade</th>
    <th>Categoria</th>
  </tr>
<?php 
       $model = new Model();
       $listarProduto = $model->listar();
       
       if(!empty($listarProduto)){
        foreach($listarProduto as $row){ 
?>

  <tr>
    <td><?php echo $row['nomeProd'] ?></td>
    <td><?php echo $row['quantidadeProd'] ?></td>
    <td><?php echo $row['categoriaProd'] ?></td>
  </tr>

<?php
    }
}
?> 
</table>

</body>
</html>



