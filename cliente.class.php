<?php 
class cliente_class{
    private $id_cliente;
    private $nome;
    private $cpf;
    private $telefone;

    public function setId_Cliente($id_cliente){
        $this->id_cliente = $id_cliente;
    }
    public function getId_Cliente(){
        return $this->id_cliente;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
}
?>