<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover produto - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <a href="produtoLista.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
        <h2>Remover produto</h2>

        <p>ℹ️ Apenas remova um produto quando ele não será mais comercializado.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id_produto">Índice:</label>
            <br>
            <input type="number" name="id_produto" id="id_produto" min="1">
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
    $p->setIdProduto($_POST["id_produto"]);

    if ($p->deletarProduto()) {
        header("Location: produtoLista.php");
        exit();
    } else {
        echo "Falha ao inserir!";
    }
}
?>