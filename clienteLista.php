<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar clientes - Bodegão</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function pesquisarClientes() {
            var input = document.getElementById('search').value.toLowerCase();
            var clientes = document.getElementsByClassName('cliente');
            for (var i = 0; i < clientes.length; i++) {
                var nome = clientes[i].getElementsByClassName('nome')[0].innerText.toLowerCase();
                if (nome.includes(input)) {
                    clientes[i].style.display = '';
                } else {
                    clientes[i].style.display = 'none';
                }
            }
        }
    </script>
</head>

<body>
    <iframe src="partials/header.html" frameborder="0" width="100%" height="100px"></iframe>

    <div>
        <div class="flex">
            <a href="clienteAdd.php"><button><img src="resources/add.svg"> Inserir</button></a>
            <a href="clienteEdit.php"><button><img src="resources/edit.svg" alt=""> Editar</button></a>
            <input type="text" id="search" placeholder="Pesquisar por um cliente..." onkeydown="pesquisarClientes()">
            <button onclick="pesquisarClientes()"><img src="resources/search.svg"></button>
        </div>

        <br>
        <hr>

        <?php
        include "Cliente.class.php";

        $p = new Cliente_class;
        $pessoas = $p->listarClientes();
        foreach ($pessoas as $pessoa) {
            echo '<div class="cliente">';
            echo '<b>Nome: </b><span class="nome">' . $pessoa['nome'] . '</span><br>';
            echo "<b>CPF: </b>" . $pessoa['cpf'] . "<br>";
            echo "<b>Contato: </b>" . $pessoa['contato'] . "<br>";
            echo "<b>Índice: </b>" . $pessoa['id_cliente'] . "<br><hr>";
            echo "<a href=\"comandaAdd.php?id_cliente=" . $pessoa['id_cliente'] . "\"><button>Abrir comanda</button></a>";
            echo "<a href=\"clienteEdit.php?id_cliente=" . $pessoa['id_cliente'] . "&nome=" . $pessoa['nome'] . "&cpf=" . $pessoa['cpf'] . "&contato=" . $pessoa['contato'] . "\"><button>Editar</button></a>";
            echo '</div>';
        }
        ?>
    </div>

</body>

</html>