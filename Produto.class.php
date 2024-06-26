<?php
include_once "conexao.class.php";
class Produto_class {
    private $id_produto;
    private $nome;
    private $marca;
    private $tamanho;
    private $validade;
    private $quantidade;
    private $preco;

    #region get/set
    public function getIdProduto() {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    public function getValidade() {
        return $this->validade;
    }

    public function setValidade($validade) {
        $this->validade = $validade;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
    #endregion
    function listarProdutos()
    {
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "SELECT * FROM produtos";
        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo 'Erro ao listar: ' . $e->getMessage();
            $result = [];
            return $result;
        }

    }

    function inserirProduto()
    {
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "INSERT INTO produtos (nome, marca, tamanho, validade, quantidade, preco) VALUES (:nome, :marca, :tamanho, :validade, :quantidade, :preco)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':tamanho', $this->tamanho);
            $stmt->bindParam(':validade', $this->validade);
            $stmt->bindParam(':quantidade', $this->quantidade);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            return false;
        }
    }
    function atualizarProduto()
    {
        $database = new Conexao();
        $db = $database->getConnection();

        $sql = "UPDATE produtos SET nome = :nome, marca = :marca, tamanho = :tamanho, validade = :validade, quantidade = :quantidade, preco = :preco WHERE id_produto = :id_produto";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":marca", $this->marca);
            $stmt->bindParam(":tamanho", $this->tamanho);
            $stmt->bindParam(":validade", $this->validade);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return false;
        }
    }
    function deletarProduto(){
        $database = new Conexao();
        $db = $database->getConnection();

        $sql = "DELETE FROM produtos WHERE id_produto = :id_produto";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->execute();
            return true;
        } catch (PDOException $e){
            echo "Erro ao deletar: " . $e->getMessage();
            return false;
        }
    }
}
?>
