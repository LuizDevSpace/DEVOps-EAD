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
        $data = array();
        
        $listarQuery = "SELECT * FROM produto";
        
        if ($stmt = $this->conn->prepare($listarQuery)) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($linha = $result->fetch_assoc()) {
                    $data[] = $linha;
                }
                $stmt->close();
            } else {
               echo "Não foi possível realizar a consulta";
            }
        } else {
            "Erro";
        }
        
        return $data;
    } #FIM Listar Produto
}