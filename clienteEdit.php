<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <a href="clienteLista.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
        <h2>Editar cliente</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id_cliente">Índice:</label>
            <br>
            <input type="number" name="id_cliente" id="id_cliente" min="1" required
                value="<?php echo isset($_GET['id_cliente']) ? $_GET['id_cliente'] : ''; ?>">
            <br><br>
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome" required
                value="<?php echo isset($_GET['nome']) ? $_GET['nome'] : ''; ?>">
            <br><br>
            <label for="cpf">CPF:</label>
            <br>
            <input type="text" name="cpf" id="cpf" value="<?php echo isset($_GET['cpf']) ? $_GET['cpf'] : ''; ?>">
            <br><br>
            <label for="contato">Contato:</label>
            <br>
            <input type="text" name="contato" id="contato"
                value="<?php echo isset($_GET['contato']) ? $_GET['contato'] : ''; ?>">
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente'])) {
    include "cliente.class.php";

    $p = new Cliente_class();
    $p->setIdCliente($_POST["id_cliente"]);
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

    if ($p->atualizarPessoa()) {
        header("Location: clienteLista.php");
        exit();
    } else {
        echo "Falha ao editar!";
    }
}
?>