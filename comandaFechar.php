<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechar comanda - Bodegão</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>
    <br>
    <div>
        <h2>Fechar comanda?</h2>
        <p>Você tem certeza que deseja fechar esta comanda?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="id_comanda" hidden>Índice da comanda:</label>
            <input type="number" name="id_comanda" id="id_comanda" min="1" value="<?php echo $_GET['id_comanda']; ?>"hidden>
            <div class="flex">
                <button type="submit">
                    <img src="resources/check.svg" alt="Salvar"> Sim
                </button>
                <a href="index.php"><button><img src="resources/arrow_back.svg" alt=""> Voltar</button></a>
            </div>
        </form>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "Comanda.class.php";

    if (isset($_POST['id_comanda'])) {
        $id_comanda = $_POST['id_comanda'];

        $c = new Comanda_class();

        $resultado = $c->fecharComanda($id_comanda);

        header("Location: index.php");
    } else {
        echo "ID da comanda não especificado.";
        echo "<a href=\"index.php\">Voltar a home</a>";
    }
}
?>