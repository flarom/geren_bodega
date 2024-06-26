<?php
    include_once "conexao.class.php";
class Comanda_class
{
    private $id_comanda;
    private $id_cliente;
    private $data;
    private $id_produto = [];
    private $quantidade = [];
    private $total = 0;

    #region getter e setter
    public function setIdComanda($id_comanda)
    {
        $this->id_comanda = $id_comanda;
    }
    public function getIdComanda()
    {
        return $this->id_comanda;
    }
    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }
    public function getIdCliente()
    {
        return $this->id_cliente;
    }
    public function setData()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d', time());
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }
    public function addIdProduto($id_produto){
        array_push($this->id_produto, $id_produto);
    }
    public function getIdProduto(){
        return $this->id_produto;
    }
    public function addQuantidade($quantidade){
        array_push($this->quantidade, $quantidade);
    }
    public function getQuantidade(){
        return $this->quantidade;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function getTotal(){
        return $this->total;
    }
    #endregion
    public function addTotal($id_produto, $qtd) {
        $database = new Conexao();
        $db = $database->getConnection();

        $sql = "SELECT preco FROM produtos WHERE id_produto = :id_produto";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_produto', $id_produto);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $this->total += $result['preco'] * $qtd;
            } else {
                echo "Produto não encontrado.";
            }

        } catch (PDOException $e) {
            echo 'Erro ao obter preço do produto: ' . $e->getMessage();
        }
    }
    public function subQtdProduto($id_produto, $qtd){
        $database = new Conexao();
        $db = $database->getConnection();
    
        $sql = "UPDATE produtos SET quantidade = quantidade - :qtd WHERE id_produto = :id_produto";
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':qtd', $qtd, PDO::PARAM_INT);
            $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao atualizar quantidade do produto: ' . $e->getMessage();
            return false;
        }
    }
    public function updateTotal(){
        $database = new Conexao();
        $db = $database->getConnection();
    
        $sql = "UPDATE comanda SET total = total + :total WHERE id_comanda = :id_comanda";
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':total', $this->total, PDO::PARAM_INT);
            $stmt->bindParam(':id_comanda', $this->id_comanda, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Erro ao atualizar total da comanda: ' . $e->getMessage();
            return false;
        }
    }
    public function inserirComanda(){
        $database = new Conexao();
        $db = $database->getConnection();

        $sql = "INSERT INTO comanda (id_cliente, data, total, aberto) VALUES (:id_cliente, :data, :total, 1)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_cliente', $this->id_cliente);
            $stmt->bindParam(':data', $this->data);
            $stmt->bindParam(':total', $this->total);
            $stmt->execute();

            $this->id_comanda = $db->lastInsertId();
            return true;

        } catch (PDOException $e) {
            echo "<br><b>Erro ao criar comanda: </b>" . $e->getMessage();
            return false;
        }
    }
    public function inserirComandaProduto(){
        $database = new Conexao();
        $db = $database->getConnection();
        foreach ($this->id_produto as $idx => $produto_id){
            $sql = "INSERT INTO comandaproduto (id_comanda, id_produto, quantidade) VALUES (:id_comanda, :id_produto, :quantidade)";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id_comanda', $this->id_comanda);
                $stmt->bindParam(':id_produto', $produto_id);
                $stmt->bindParam(':quantidade', $this->quantidade[$idx]);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "<br><b>Erro ao relacionar produto a comanda: </b>" . $e->getMessage();
                return false;
            }
        }
        
        return true;
    }
    function listarComandasAbertas()
    {
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "SELECT comanda.*, clientes.nome AS nome_cliente 
            FROM comanda 
            INNER JOIN clientes ON comanda.id_cliente = clientes.id_cliente
            WHERE comanda.aberto = 1";
        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo 'Erro ao listar comandas: ' . $e->getMessage();
            $result = [];
            return $result;
        }
    }
    function listarComandasFechadas(){
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "SELECT comanda.*, clientes.nome AS nome_cliente 
            FROM comanda 
            INNER JOIN clientes ON comanda.id_cliente = clientes.id_cliente
            WHERE comanda.aberto = 0";
        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo 'Erro ao listar comandas: ' . $e->getMessage();
            $result = [];
            return $result;
        }
    }
    function listarItens($id_comanda) {
        $database = new Conexao();
        $db = $database->getConnection();
    
        $sql = "SELECT produtos.nome AS nome_produto, produtos.preco, cp.quantidade, 
                       (produtos.preco * cp.quantidade) AS preco_total
                FROM comandaproduto cp
                INNER JOIN produtos ON cp.id_produto = produtos.id_produto
                WHERE cp.id_comanda = :id_comanda";
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_comanda', $id_comanda);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    
        } catch (PDOException $e) {
            echo 'Erro ao listar itens da comanda: ' . $e->getMessage();
            return [];
        }
    }
    function fecharComanda($id_comanda) {
        $database = new Conexao();
        $db = $database->getConnection();
    
        $sql = "UPDATE comanda SET aberto = 0 WHERE id_comanda = :id_comanda";
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_comanda', $id_comanda);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    
        } catch (PDOException $e) {
            echo 'Erro ao fechar comanda: ' . $e->getMessage();
            return false;
        }
    }
}
?>