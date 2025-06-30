# Guia de Migração para Arquitetura MVC

Este guia explica como migrar seu projeto atual para a nova arquitetura MVC com Composer.

## O que foi criado

### 1. Estrutura de Diretórios
```
app/
├── Controllers/     # Controladores da aplicação
├── Models/         # Modelos de dados
├── Views/          # Views/templates
└── Router.php      # Sistema de roteamento

config/             # Arquivos de configuração
public/             # Arquivos públicos (DocumentRoot)
vendor/             # Dependências do Composer
```

### 2. Arquivos Principais

#### Composer
- `composer.json` - Configuração do projeto e autoload PSR-4
- `vendor/` - Dependências instaladas

#### Configuração
- `config/database.php` - Configuração do banco de dados
- `config/app.php` - Configurações gerais da aplicação

#### Ponto de Entrada
- `public/index.php` - Arquivo principal que recebe todas as requisições
- `public/.htaccess` - Configuração do Apache para URL rewriting

## Como usar a nova estrutura

### 1. Configuração do Servidor

Configure seu servidor web para apontar o DocumentRoot para a pasta `public/`:

**Apache (httpd.conf ou .htaccess):**
```apache
DocumentRoot "/caminho/para/ProjetoIntegradorFerraz/public"
```

**XAMPP:**
- Edite o arquivo `httpd.conf`
- Altere a linha `DocumentRoot` para apontar para a pasta `public`

### 2. Rotas

As rotas são definidas no arquivo `public/index.php`:

```php
// Exemplo de rota
$router->get('/vagas', 'VagaController@index');
$router->get('/vagas/{id}', 'VagaController@show');
$router->post('/vagas/criar', 'VagaController@create');
```

### 3. Controladores

Os controladores ficam em `app/Controllers/` e herdam da classe base `Controller`:

```php
<?php
namespace App\Controllers;

use App\Models\Vaga;

class VagaController extends Controller
{
    private $vagaModel;

    public function __construct()
    {
        $this->vagaModel = new Vaga();
    }

    public function index()
    {
        $vagas = $this->vagaModel->findAll();
        return $this->render('vagas/index', ['vagas' => $vagas]);
    }
}
```

### 4. Modelos

Os modelos ficam em `app/Models/` e herdam da classe base `Model`:

```php
<?php
namespace App\Models;

class Vaga extends Model
{
    protected $table = 'vagas';

    public function buscarVagas($termo)
    {
        $sql = "SELECT * FROM {$this->table} WHERE titulo LIKE ?";
        return $this->db->fetchAll($sql, ["%{$termo}%"]);
    }
}
```

### 5. Views

As views ficam em `app/Views/` e podem usar variáveis passadas pelo controlador:

```php
<!-- app/Views/vagas/index.php -->
<?php foreach ($vagas as $vaga): ?>
    <div class="card">
        <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
        <p><?= htmlspecialchars($vaga['descricao']) ?></p>
    </div>
<?php endforeach; ?>
```

## Migrando arquivos existentes

### 1. Migrar Views

Para migrar uma página existente:

1. **Crie um controlador** em `app/Controllers/`
2. **Mova o HTML** para `app/Views/`
3. **Separe a lógica PHP** entre controlador e modelo

**Exemplo - Antes (vagas.php):**
```php
<?php include "navbar.php"; include "database.php"; ?>
<main>
    <?php
        $sql = "SELECT * FROM vagas";
        $resultado = mysqli_query($conexao, $sql);
        while ($vaga = mysqli_fetch_assoc($resultado)) {
            echo "<div class='card'>";
            echo "<h3>" . $vaga['titulo'] . "</h3>";
            echo "</div>";
        }
    ?>
</main>
```

**Exemplo - Depois:**

**Controlador (app/Controllers/VagaController.php):**
```php
public function index()
{
    $vagas = $this->vagaModel->findAll();
    return $this->render('vagas/index', ['vagas' => $vagas]);
}
```

**View (app/Views/vagas/index.php):**
```php
<?php foreach ($vagas as $vaga): ?>
    <div class="card">
        <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
    </div>
<?php endforeach; ?>
```

### 2. Migrar Formulários

**Antes:**
```php
<form action="processa_cadastro.php" method="post">
```

**Depois:**
```php
<form action="/cadastro" method="post">
```

### 3. Migrar Links

**Antes:**
```php
<a href="vagas.php?id=<?= $vaga['id'] ?>">
```

**Depois:**
```php
<a href="/vagas/<?= $vaga['id'] ?>">
```

## Benefícios da nova estrutura

1. **Separação de responsabilidades** - Código mais organizado
2. **Reutilização** - Models e Views podem ser reutilizados
3. **Manutenibilidade** - Mais fácil de manter e expandir
4. **Segurança** - Melhor controle de acesso e validação
5. **Escalabilidade** - Estrutura preparada para crescimento

## Próximos passos

1. Configure o servidor para usar a pasta `public/` como DocumentRoot
2. Teste as rotas básicas (`/`, `/vagas`)
3. Migre gradualmente as páginas existentes
4. Implemente as views que faltam
5. Adicione validações e melhorias de segurança

## Troubleshooting

### Erro 404
- Verifique se o mod_rewrite está habilitado
- Confirme se o DocumentRoot está apontando para `public/`

### Erro de autoload
- Execute `composer install` para gerar o autoload
- Verifique se os namespaces estão corretos

### Erro de banco de dados
- Confirme as credenciais em `config/database.php`
- Verifique se o PDO está habilitado no PHP 