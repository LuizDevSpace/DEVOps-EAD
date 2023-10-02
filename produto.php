<?php
include_once "Model.php";
$model = new Model();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Faculdade Impacta Luiz Otávio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Mercadinho da Esquina</h1>


<table>
  <tr>
    <th></th>
    <th>Nome</th>
    <th>Quantidade</th>
    <th>Categoria</th>
  </tr>
<?php 
       $model = new Model();
       $listarProduto = $model->verProduto();
       
       if(!empty($listarProduto)){
        foreach($listarProduto as $linha){ 
?>

  <tr>
    <td>
    <?php echo "<img src='uploads/{$linha['imagemProd']}' style='width:100px; height:100px;'>"; ?>
    </td>
    <td><?php echo $linha['nomeProd']; ?></td>
    <td style="text-align:center;"><?php echo $linha['quantidadeProd']; ?></td>
    <td><?php echo $linha['categoriaProd']; ?></td>
     <td>
       <a href="index.php" title="Voltar">Voltar</a>
     </td>
  </tr>

<?php
    }
}
?> 
</table>


</body>
</html>



