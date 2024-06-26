<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova comanda - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <a href="index.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
        <h2>Nova comanda</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id_cliente">Índice do cliente:</label>
            <br>
            <input type="number" name="id_cliente" id="id_cliente" min="1"
                value="<?php echo isset($_GET['id_cliente']) ? $_GET['id_cliente'] : ''; ?>" required>
            <br>
            <a href="clienteAdd.php" target="_blank">Novo cliente?</a>
            <br><br>
            <label for="">Produtos:</label>
            <br>
            <div class="semBorda" id="produtos-container">
                <div class="produto-item">
                    <label for="id_produto">Produto:</label>
                    <br>
                    <select name="id_produto[]" class="id_produto" required>
                        <option value="">Selecione um produto...</option>
                        <?php
                        include "Produto.class.php";
                        $p = new Produto_class;
                        $produtos = $p->listarProdutos();

                        foreach ($produtos as $produto) {
                            echo '<option value="' . $produto['id_produto'] . '">' . $produto['nome'] . " " . $produto['marca']. " " . $produto["tamanho"] . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <label for="quantidade">Quantidade:</label>
                    <br>
                    <input type="number" name="quantidade[]" class="quantidade" min="1" required>
                </div>
            </div>
            <br><br>
            <button type="button" id="outro-item"><img src="resources/add.svg"> Adicionar item</button>
            <hr>
            <button type="submit">
                <img src="resources/check.svg" alt="Salvar"> Salvar
            </button>
            <button type="reset">
                <img src="resources/close.svg" alt="Limpar"> Limpar
            </button>
        </form>
    </div>

    <script>
        document.getElementById('outro-item').addEventListener('click', function () {
            var ultimoItem = document.querySelector('.produto-item:last-of-type');
            var novoItem = ultimoItem.cloneNode(true);

            novoItem.querySelector('.id_produto').value = '';
            novoItem.querySelector('.quantidade').value = '';

            document.getElementById('produtos-container').appendChild(novoItem);
        });
    </script>
</body>

</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente'])) {
    include "comanda.class.php";

    $c = new Comanda_class();

    $c->setData();
    $c->setIdCliente($_POST["id_cliente"]);

    foreach ($_POST['id_produto'] as $key => $id_produto) {
        $c->addIdProduto($id_produto);
        $c->addQuantidade($_POST['quantidade'][$key]);
        $c->subQtdProduto($id_produto, $_POST['quantidade'][$key]);
        $c->addTotal($id_produto, $_POST['quantidade'][$key]);
    }

    $c->inserirComanda();
    $c->inserirComandaProduto();
    header("Location: index.php");
}
?>