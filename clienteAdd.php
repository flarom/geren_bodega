<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir cliente - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <a href="clienteLista.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
        <h2>Inserir cliente</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome" required>
            <br><br>
            <label for="cpf">CPF (opcional):</label>
            <br>
            <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="000.000.000-00">
            <br><br>
            <label for="contato">Contato (opcional):</label>
            <br>
            <input type="text" name="contato" id="contato" placeholder="+55 54 9900-0000">
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
    include "cliente.class.php";

    $p = new Cliente_class();
    $p->setNome($_POST["nome"]);
    if ($_POST["cpf"] != null) {
        $p->setCpf($_POST["cpf"]);
    } else {
        $p->setCpf("Não declarado");
    }
    if ($_POST["contato"] != null) {
        $p->setContato($_POST["contato"]);
    } else {
        $p->setContato("Não declarado");
    }

    if ($p->inserirPessoa()) {
        header("Location: clienteLista.php");
        exit();
    } else {
        echo "Falha ao inserir!";
    }
}
?>