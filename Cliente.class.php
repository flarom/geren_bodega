<?php
include "conexao.class.php";
class Cliente_class
{
    private $id_cliente;
    private $nome;
    private $cpf;
    private $contato;

    #region get/set
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function setContato($contato)
    {
        $this->contato = $contato;
    }
    #endregion
    function listarClientes()
    {
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "SELECT * FROM clientes";
        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo 'Erro ao listar pessoas: ' . $e->getMessage();
            $result = [];
            return $result;
        }

    }
    function inserirPessoa()
    {
        $database = new Conexao(); // nova instância da conexao
        $db = $database->getConnection(); // tenta conectar

        $sql = "INSERT INTO clientes (nome, cpf, contato) VALUES (:nome, :cpf, :contato)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':contato', $this->contato);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            return false;
        }
    }
    function atualizarPessoa()
    {
        $database = new Conexao();
        $db = $database->getConnection();

        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, contato = :contato WHERE id_cliente = :id_cliente";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":contato", $this->contato);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return false;
        }
    }
}
?>