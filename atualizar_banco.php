<?php
include "database.php";

// Script para atualizar a estrutura do banco de dados

echo "<h2>Atualizando estrutura do banco de dados...</h2>";

// 1. Verifica se a coluna data_candidatura existe na tabela candidaturas
$check_column = mysqli_query($conexao, "SHOW COLUMNS FROM candidaturas LIKE 'data_candidatura'");

if (mysqli_num_rows($check_column) == 0) {
    // Adiciona a coluna data_candidatura
    $add_column = mysqli_query($conexao, "ALTER TABLE candidaturas ADD COLUMN data_candidatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    
    if ($add_column) {
        echo "<p style='color: green;'>✓ Coluna 'data_candidatura' adicionada com sucesso!</p>";
        
        // Atualiza registros existentes com a data atual
        $update_existing = mysqli_query($conexao, "UPDATE candidaturas SET data_candidatura = NOW() WHERE data_candidatura IS NULL");
        if ($update_existing) {
            echo "<p style='color: green;'>✓ Registros existentes atualizados com a data atual!</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Erro ao adicionar coluna 'data_candidatura': " . mysqli_error($conexao) . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ Coluna 'data_candidatura' já existe!</p>";
}

// 2. Verifica se a tabela candidaturas tem a estrutura básica
$check_table = mysqli_query($conexao, "DESCRIBE candidaturas");

if (mysqli_num_rows($check_table) == 0) {
    // Cria a tabela candidaturas se não existir
    $create_table = mysqli_query($conexao, "
        CREATE TABLE candidaturas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT NOT NULL,
            id_vaga INT NOT NULL,
            data_candidatura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
            FOREIGN KEY (id_vaga) REFERENCES vagas(id) ON DELETE CASCADE,
            UNIQUE KEY unique_candidatura (id_usuario, id_vaga)
        )
    ");
    
    if ($create_table) {
        echo "<p style='color: green;'>✓ Tabela 'candidaturas' criada com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>✗ Erro ao criar tabela 'candidaturas': " . mysqli_error($conexao) . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ Tabela 'candidaturas' já existe!</p>";
}

// 3. Verifica se a tabela usuarios tem todas as colunas necessárias
$check_usuarios_columns = mysqli_query($conexao, "SHOW COLUMNS FROM usuarios");

$required_columns = [
    'id', 'nome', 'email', 'senha', 'cpf', 'data_nascimento', 
    'telefone', 'cidade', 'estado', 'cep', 'endereco', 
    'escolaridade', 'experiencia', 'area_interesse', 'observacoes', 
    'data_cadastro', 'ativo', 'tipo_usuario'
];

$existing_columns = [];
while ($column = mysqli_fetch_assoc($check_usuarios_columns)) {
    $existing_columns[] = $column['Field'];
}

foreach ($required_columns as $column) {
    if (!in_array($column, $existing_columns)) {
        echo "<p style='color: orange;'>⚠ Coluna '$column' não encontrada na tabela usuarios. Pode ser necessário adicionar manualmente.</p>";
    }
}

echo "<h3>Verificação concluída!</h3>";
echo "<p><a href='index.php'>Voltar para a página inicial</a></p>";
?> 