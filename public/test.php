<?php
// Habilitar exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h1>Teste PHP</h1>";
echo "<p>PHP está funcionando!</p>";

// Testar autoload
echo "<h2>Testando Autoload</h2>";
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    echo "<p>✅ Autoload carregado com sucesso</p>";
} catch (Exception $e) {
    echo "<p>❌ Erro no autoload: " . $e->getMessage() . "</p>";
}

// Testar classes
echo "<h2>Testando Classes</h2>";
try {
    $router = new App\Router();
    echo "<p>✅ Router criado com sucesso</p>";
} catch (Exception $e) {
    echo "<p>❌ Erro ao criar Router: " . $e->getMessage() . "</p>";
}

// Testar banco de dados
echo "<h2>Testando Banco de Dados</h2>";
try {
    $db = App\Models\Database::getInstance();
    echo "<p>✅ Conexão com banco estabelecida</p>";
    
    // Testar consulta simples
    $result = $db->fetch("SELECT COUNT(*) as total FROM vagas");
    echo "<p>✅ Consulta executada. Total de vagas: " . $result['total'] . "</p>";
} catch (Exception $e) {
    echo "<p>❌ Erro no banco: " . $e->getMessage() . "</p>";
}

// Testar controlador
echo "<h2>Testando Controlador</h2>";
try {
    $controller = new App\Controllers\HomeController();
    echo "<p>✅ HomeController criado com sucesso</p>";
} catch (Exception $e) {
    echo "<p>❌ Erro ao criar HomeController: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><strong>Se todos os testes passaram, o problema pode estar no roteamento ou nas views.</strong></p>";
?> 