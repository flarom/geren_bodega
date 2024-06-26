<?php
class Conexao
{
    private $host = 'localhost'; //Endereço do servidor do banco de dados
    private $db_name = 'bodega'; //nome do banco de dados
    private $username = 'root'; //nome do usuário do banco de dados
    private $password = ''; //senha do banco de dados
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try { //tentar conectar
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
?>