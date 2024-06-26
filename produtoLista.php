<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar produtos - Bodegão</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function pesquisarProdutos() {
            var input = document.getElementById('search').value.toLowerCase();
            var produtos = document.getElementsByClassName('produto');
            for (var i = 0; i < produtos.length; i++) {
                var nome = produtos[i].getElementsByClassName('nome')[0].innerText.toLowerCase();
                var marca = produtos[i].getElementsByClassName('marca')[0].innerText.toLowerCase();
                if (nome.includes(input) || marca.includes(input)) {
                    produtos[i].style.display = '';
                } else {
                    produtos[i].style.display = 'none';
                }
            }
        }
    </script>
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <div>
        <div class="flex">
            <a href="produtoAdd.php"><button><img src="resources/add.svg"> Inserir</button></a>
            <a href="produtoEdit.php"><button><img src="resources/edit.svg"> Editar</button></a>
            <a href="produtoDelete.php"><button><img src="resources/close.svg"> Remover</button></a>
            <input type="text" id="search" placeholder="Pesquisar por um produto..." onkeydown="pesquisarProdutos()">
            <button onclick="pesquisarProdutos()"><img src="resources/search.svg"></button>
        </div>

        <br>
        <hr>

        <?php
        include "Produto.class.php";

        $p = new Produto_class;
        $produtos = $p->listarProdutos();
        foreach ($produtos as $produto) {
            echo '<div class="produto">';
            echo '<b>Nome: </b><span class="nome">' . $produto['nome'] . '</span><br>';
            echo '<b>Marca: </b><span class="marca">' . $produto['marca'] . '</span><br>';
            echo "<b>Tamanho: </b>" . $produto['tamanho'] . "<br>";
            echo "<b>Validade: </b>" . $produto['validade'];
            if ($produto['validade'] <= date('Y-m-d')) {
                echo "<b> <font color=\"#ffab56\"> FORA DE VALIDADE </font> </b>";
            }
            echo "<br>";
            echo "<b>Quantidade em estoque: </b>" . $produto['quantidade'];
            if ($produto['quantidade'] <= 0) {
                echo "<b><font color=\"#ffab56\"> ESGOTADO </font> </b>";
            }
            echo "<br>";
            echo "<b>Preço: </b> R$" . number_format($produto['preco'], 2) . "<br>";
            echo "<b>Índice: </b>" . $produto['id_produto'] . "<br><hr>";
            echo "<a href=\"produtoEdit.php?id_produto=" . $produto['id_produto'] . "&nome=" . $produto['nome'] .
                "&marca=" . $produto['marca'] . "&tamanho=" . $produto['tamanho'] . "&validade=" . $produto['validade'] .
                "&quantidade=" . $produto['quantidade'] . "&preco=" . $produto['preco'] . "\"><button>Editar</button></a>";
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>