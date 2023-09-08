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
            $nomeProd = filter_input(INPUT_POST, 'nomeProd', FILTER_SANITIZE_SPECIAL_CHARS);
            $quantidadeProd = filter_input(INPUT_POST, 'quantidadeProd', FILTER_VALIDATE_INT);
            $categoriaProd = filter_input(INPUT_POST, 'categoriaProd', FILTER_SANITIZE_SPECIAL_CHARS);
        

            
            
            $queryInserir = "INSERT INTO produto (nomeProd, quantidadeProd, categoriaProd) 
                             VALUES (?, ?, ?)";
            
            $stmt = $this->conn->prepare($queryInserir);
            
            $stmt->bind_param("sis", $nomeProd, $quantidadeProd, $categoriaProd);
            if($stmt->execute()){
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
    

    public function verProduto(){
        if(isset($_GET['id'])){
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $data = array();
        
            $listarQuery = "SELECT * FROM produto WHERE id = ?";
        
            if ($stmt = $this->conn->prepare($listarQuery)) {
                $stmt->bind_param("i", $id); 
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows === 0) {
                        header("Location: index.php");
                        exit();
                    }
                    while ($linha = $result->fetch_assoc()) {
                        $data[] = $linha;
                    }
                    $stmt->close();
                } else {
                    echo "Não foi possível realizar a consulta!";
                }
                 } else {
                echo "Erro"; 
            }
            return $data;
        }
    }
    
}