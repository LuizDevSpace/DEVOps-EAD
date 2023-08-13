<?php

class Model{

 
    private $servername = "localhost";
    private $username = "root";
    private $password;
    private $database = "faculdade";
    private $conn;

    
    
    public function __construct(){
    
    try {
    
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->database);
    
    } catch (Exception $e) {
        echo "Conexão com banco de dados falhou" . $e->getMessage();
        }
    }

    public function inserir(){
        if (isset($_POST['adicionarProduto'])){
            $nomeProd = $_POST['nomeProd'];
            $quantidadeProd = $_POST['quantidadeProd'];
            $categoriaProd = $_POST['categoriaProd'];
            
            $queryInserir = "INSERT INTO produto (nomeProd, quantidadeProd, categoriaProd) 
                             VALUES (?, ?, ?)";
            
            $stmt = $this->conn->prepare($queryInserir);
            
            $stmt->bind_param("sis", $nomeProd, $quantidadeProd, $categoriaProd);
            
            if ($stmt->execute()){
                echo '<script>alert("Produto cadastrado com Sucesso!")</script>';
            }
            
            $stmt->close();
        }
    }#FIM Inserir Produto

      public function listar(){
        $data = null;

        $listarQuery = "SELECT * FROM produto";

        if($executaQuery = $this->conn->query($listarQuery)){
            while($linha = mysqli_fetch_assoc($executaQuery )){
                $data[] = $linha;
            }
        }
        return $data;
         } #FIM Listar Produto
}