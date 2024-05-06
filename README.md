# bodega

## cliente
- id_cliente
- nome
- [cpf]
- [telefone]

## produto
- id_produto
- nome
- marca
- tamanho
- validade
- quantidade
- preço

## comanda
- id_comanda
- id_cliente
- id_produto[]
- quantidade
- \+ imprimir()

## relatorio
- id_comanda[]
- \+ imprimir()