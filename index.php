<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>

    <h2>Comandas Abertas:</h2>
    <div class="comandas">
        <?php
        include "Comanda.class.php";

        $c = new Comanda_class;
        $comandas = $c->listarComandasAbertas();
        foreach ($comandas as $comanda) {
            echo '<div class="comanda">';
            echo '<b>ID da comanda: </b><span class="id_comanda">' . $comanda['id_comanda'] . '</span><br>';
            echo "<b>ID do usuario: </b>" . $comanda['id_cliente'] . "<br>";
            echo "<b>Data: </b>" . $comanda['data'] . "<br>";
            echo "<b>Nome: </b>" . $comanda['nome_cliente'] . "<br>";
            echo "<b>ITENS: </b><br>";
            $itens = $c->listarItens($comanda['id_comanda']);

            foreach ($itens as $item) {
                echo "<b> • </b>" . $item['nome_produto'] . " (" . $item['quantidade'] . "): R$" . number_format($item['preco_total'], 2) . "<br>";
            }
            echo "<br>";
            echo "<b>TOTAL: </b> R$" . number_format($comanda['total'], 2);
            echo "<br><hr>";
            echo '<a href="comandaAddItem.php?id_comanda=' . $comanda['id_comanda'] .'"><button><img src="resources/add.svg">Adicionar itens</button></a>';
            echo '<a href="comandaFechar.php?id_comanda=' . $comanda['id_comanda'] . '"><button><img src="resources/close.svg"> Fechar comanda</button></a>';
            echo '</div>';
        }   
        ?>
    </div>
    <h2>Comandas Fechadas:</h2>
    <div class="comandas">

        <?php
        $comandas = $c->listarComandasFechadas();
        foreach ($comandas as $comanda) {
            echo '<div class="comanda">';
            echo '<b>ID da comanda: </b><span class="id_comanda">' . $comanda['id_comanda'] . '</span><br>';
            echo "<b>ID do usuario: </b>" . $comanda['id_cliente'] . "<br>";
            echo "<b>Data: </b>" . $comanda['data'] . "<br>";
            echo "<b>Nome: </b>" . $comanda['nome_cliente'] . "<br>";
            echo "<b>ITENS: </b><br>";
            $itens = $c->listarItens($comanda['id_comanda']);

            foreach ($itens as $item) {
                echo "<b> • </b>" . $item['nome_produto'] . " (" . $item['quantidade'] . "): R$" . number_format($item['preco_total'], 2) . "<br>";
            }
            echo "<br>";
            echo "<b>TOTAL: </b> R$" . number_format($comanda['total'], 2);
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>