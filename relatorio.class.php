<?php 
class Relatorio_class{
    private Comanda_class $comandas = array();

    public function addComanda($comanda){
        array_push($this->comandas, $comanda);
    }
    public function imprimir(){
        foreach ($this->comandas as $comanda) {
            echo $comanda->getCliente . "<br>";
            echo $comanda->getProduto->getNome; 
        }
    }
}
?>