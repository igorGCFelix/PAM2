<?php
include_once('conexao.php');

try {
    // Testa a conexão
    echo "<h2>Teste de Conexão</h2>";
    echo "Conexão com o banco de dados estabelecida com sucesso!<br><br>";

    // Lista as tabelas
    echo "<h2>Tabelas no Banco</h2>";
    $query = $pdo->query("SHOW TABLES");
    $tabelas = $query->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabelas encontradas: " . implode(", ", $tabelas) . "<br><br>";

    // Mostra os produtos
    echo "<h2>Produtos Cadastrados</h2>";
    $query = $pdo->query("SELECT * FROM produtos");
    $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($produtos) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Marca</th><th>Preço</th><th>Estoque</th><th>Descrição</th></tr>";
        
        foreach ($produtos as $produto) {
            echo "<tr>";
            echo "<td>" . $produto['id'] . "</td>";
            echo "<td>" . $produto['nome'] . "</td>";
            echo "<td>" . $produto['marca'] . "</td>";
            echo "<td>" . $produto['preco'] . "</td>";
            echo "<td>" . $produto['quantidade_estoque'] . "</td>";
            echo "<td>" . $produto['descricao'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "Nenhum produto cadastrado!";
    }

} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?> 