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
       $listarProduto = $model->listarProdutoPorCategoria();
       
       if(!empty($listarProduto)){
        foreach($listarProduto as $linha){ 
?>

  <tr>
    <td><?php echo $linha['nomeProd'] ?></td>
    <td><?php echo $linha['quantidadeProd'] ?></td>
    <td><?php echo $linha['categoriaProd'] ?></td>
    <td><form><input type="submit" value="Editar"></form></td>
    <td><form><input type="submit" value="Excluir"></form></td>
  </tr>

<?php
    }
}
?> 
</table>

</body>
</html>



