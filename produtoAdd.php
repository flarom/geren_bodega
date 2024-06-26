<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir produto - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <a href="produtoLista.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
        <h2>Inserir produto</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome">
            <br><br>
            <label for="marca">Marca:</label>
            <br>
            <input type="text" name="marca" id="marca">
            <br><br>
            <label for="tamanho">Tamanho:</label>
            <br>
            <input type="text" name="tamanho" id="tamanho">
            <br><br>
            <label for="validade">Validade:</label>
            <br>
            <input type="date" name="validade" id="validade">
            <br><br>
            <label for="quantidade">Quantidade em estoque:</label>
            <br>
            <input type="number" name="quantidade" id="quantidade" min="0">
            <br><br>
            <label for="preco">Preço:</label>
            <br>
            <input type="number" name="preco" id="preco" min="0" step="0.01">
            <hr>
            <button type="submit">
                <img src="resources/check.svg" alt="Salvar"> Salvar
            </button>
            <button type="reset">
                <img src="resources/close.svg" alt="Limpar"> Limpar
            </button>
        </form>
    </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    include "produto.class.php";

    $p = new Produto_class();
    $p->setNome($_POST["nome"]);
    $p->setMarca($_POST["marca"]);
    $p->setTamanho($_POST["tamanho"]);
    $p->setValidade($_POST["validade"]);
    $p->setQuantidade($_POST["quantidade"]);
    $p->setPreco($_POST["preco"]);

    if ($p->inserirProduto()) {
        header("Location: produtoLista.php");
        exit();
    } else {
        echo "Falha ao inserir!";
    }
}
?>