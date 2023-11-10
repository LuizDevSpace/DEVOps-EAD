<?php


class Model {
    
    private $servername = "localhost";
    private $username = "root";
    private $password;
    private $database = "faculdade";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Conexão com banco de dados falhou: " . $e->getMessage();
        }
    }

    public function inserir() {
        if (isset($_POST['adicionarProduto'])) {
            $nomeProd = filter_input(INPUT_POST, 'nomeProd', FILTER_SANITIZE_SPECIAL_CHARS);
            $quantidadeProd = filter_input(INPUT_POST, 'quantidadeProd', FILTER_VALIDATE_INT);
            $categoriaProd = filter_input(INPUT_POST, 'categoriaProd', FILTER_SANITIZE_SPECIAL_CHARS);
            $imagemProd = filter_var(md5(uniqid()) . "_" . $_FILES["imagem"]["name"], FILTER_SANITIZE_SPECIAL_CHARS);

            $diretorio = "uploads/";
            $upload = $diretorio . $imagemProd;
    
            $queryInserir = "INSERT INTO produto (nomeProd, quantidadeProd, categoriaProd, imagemProd) 
                             VALUES (:nomeProd, :quantidadeProd, :categoriaProd, :imagemProd)";
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $upload)) {
                try {
                    $stmt = $this->conn->prepare($queryInserir);
                    $stmt->bindParam(':nomeProd', $nomeProd, PDO::PARAM_STR);
                    $stmt->bindParam(':quantidadeProd', $quantidadeProd, PDO::PARAM_INT);
                    $stmt->bindParam(':categoriaProd', $categoriaProd, PDO::PARAM_STR);
                    $stmt->bindParam(':imagemProd', $imagemProd, PDO::PARAM_STR);
                    if ($stmt->execute()) {
                        echo '<script>alert("Produto cadastrado com Sucesso!")</script>';
                    }
                } catch (PDOException $e) {
                    echo "Erro ao inserir produto: " . $e->getMessage();
                }
            } else {
                echo "Erro ao fazer upload do arquivo.";
            }
        }
    }
    


    public function listar() {
        $data = array();
        $listarQuery = "SELECT * FROM produto";

        try {
            $stmt = $this->conn->prepare($listarQuery);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "Não foi possível realizar a consulta";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return $data;
    }

    public function verProduto() {
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $data = array();
            $listarQuery = "SELECT * FROM produto WHERE id = :id";

            try {
                $stmt = $this->conn->prepare($listarQuery);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($data)) {
                        header("Location: index.php");
                        exit();
                    }
                } else {
                    echo "Não foi possível realizar a consulta!";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            return $data;
        }
    }


    public function porCategoria() {
        if (isset($_POST['listarPorCategoria'])) {
            $categoriaProd = filter_input(INPUT_POST, 'categoriaProd', FILTER_SANITIZE_SPECIAL_CHARS);
            $data = array();
            $porCategoria = "SELECT * FROM produto WHERE categoriaProd = :categoriaProd";

            try {
                $stmt = $this->conn->prepare($porCategoria);
                $stmt->bindParam(':categoriaProd', $categoriaProd, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($data)) {
                        header("Location: index.php");
                        exit();
                    }
                } else {
                    echo "Não foi possível realizar a consulta!";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            return $data;
        }
    }


    public function excluirProduto(){
        if(isset($_POST['produtoExcluir'])){ 
            $produtoExcluir = filter_input(INPUT_POST, 'produtoExcluir', FILTER_VALIDATE_INT);
            
            $excluirProduto = "DELETE FROM produto WHERE id = :produtoExcluir"; // Alterado o nome do parâmetro
    
            try {
                $stmt = $this->conn->prepare($excluirProduto);
                $stmt->bindParam(':produtoExcluir', $produtoExcluir);
                if ($stmt->execute()) {
                    echo "<script>alert('Produto excluído com sucesso!'); window.location='index.php';</script>";
                } else {
                    echo "Não foi possível excluir o produto";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    }
    


}