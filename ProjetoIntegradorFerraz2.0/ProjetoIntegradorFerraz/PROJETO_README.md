# Ferraz Conecta – Portal de Empregos
Equipe: Yuri Sales, Felipe Sales, Felipe Schueller e Nayara Bastos. 

## 📋 Descrição

O **Ferraz Conecta** é um portal dinâmico de vagas de emprego desenvolvido com **PHP** e **MySQL**, conectando candidatos e empresas da cidade de Ferraz de Vasconcelos (SP). O sistema oferece uma plataforma completa para autenticação, cadastro de usuários e visualização de oportunidades de emprego.

---

## ✨ Funcionalidades

### Para Candidatos
- ✅ **Cadastro de Usuários**: Formulário com validação de email, CPF, data de nascimento e telefone
- ✅ **Login/Autenticação**: Sistema de sessão para acesso seguro
- ✅ **Perfil de Usuário**: Visualização e gerenciamento de informações pessoais
- ✅ **Listagem de Vagas**: Cards responsivos com detalhes de oportunidades
- ✅ **Filtros de Vagas**: Busca por requisitos, salário e experiência

### Para Administrador
- ✅ **Logout Seguro**: Encerramento de sessão do usuário
- ✅ **Gerenciamento de Vagas**: Criar, editar e deletar vagas de emprego
- ✅ **Cadastro de Empresas**: Registrar empresas parceiras no sistema

### Gerais
- ✅ **Página Inicial**: Showcasing de vagas em destaque
- ✅ **Seção Sobre**: Informações sobre o portal
- ✅ **Navbar Responsiva**: Navegação intuitiva em todos os dispositivos
- ✅ **Design Responsivo**: Layout fluido para mobile, tablet e desktop
- ✅ **Acessibilidade**: Marcação semântica HTML5 e ARIA labels

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Descrição | Versão |
|-----------|-----------|---------|
| **PHP** | Backend serverside | 7.4+ |
| **MySQL** | Banco de dados | 5.7+ |
| **HTML5** | Marcação semântica | - |
| **CSS3** | Estilização (Grid, Flexbox, Variáveis) | - |
| **JavaScript** | Interatividade (futuro) | - |

---

## 📁 Estrutura do Projeto

```
ProjetoIntegradorFerraz/
│
├── Php/
│   ├── index.php              # Página principal com vagas em destaque
│   ├── cadastro.php           # Processamento de cadastro de usuários
│   ├── cadastrar.php          # Formulário de cadastro
│   ├── login.php              # Processamento de login
│   ├── entrar.php             # Formulário de login
│   ├── perfil.php             # Página de perfil do usuário
│   ├── empresas.php           # Listagem de empresas
│   ├── empresas_.php          # Administração de empresas
│   ├── vagas.php              # Listagem de vagas
│   ├── vagas_.php             # Administração de vagas
│   ├── sobre.php              # Sobre o portal
│   ├── sobre_.php             # Administração da página sobre
│   ├── navbar.php             # Menu de navegação
│   ├── navbar_.php            # Menu administrativo
│   ├── footer.php             # Rodapé
│   ├── footer_.php            # Rodapé administrativo
│   ├── database.php           # Conexão com banco de dados
│   ├── logout.php             # Encerramento de sessão
│   └── teste.php              # Arquivo de testes
│
├── Css/
│   ├── style.css              # Estilos principais
│   └── dark.css               # Tema escuro (opcional)
│
├── Img/                        # Imagens, ícones e logos
│
└── README.md                   # Este arquivo
```

---

## 🔌 Configuração do Banco de Dados

### Conexão MySQL (`database.php`)

```php
<?php
    $server_host = "localhost";
    $server_user = "root";
    $server_password = "";  // Altere conforme necessário
    $database_name = "ferrazconecta";

    $conexao = mysqli_connect($server_host, $server_user, $server_password, $database_name);
    
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }
?>
```

### Tabelas Necessárias

#### `cadastro` (Usuários)
```sql
CREATE TABLE cadastro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15),
    cpf VARCHAR(14) UNIQUE NOT NULL,
    nascimento DATE,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### `vagas` (Oportunidades de Emprego)
```sql
CREATE TABLE vagas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT,
    empresa_id INT,
    salario DECIMAL(10, 2),
    experiencia VARCHAR(100),
    escolaridade VARCHAR(50),
    idade_minima INT,
    sexo VARCHAR(20),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id)
);
```

#### `empresas` (Empresas Parceiras)
```sql
CREATE TABLE empresas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    cnpj VARCHAR(18) UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(15),
    descricao TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🚀 Instalação e Execução

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor Web (Apache, Nginx ou embutido do PHP)

### Passos

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/YuriSalesJs/ProjetoIntegradorFerraz.git
   cd ProjetoIntegradorFerraz/ProjetoIntegradorFerraz2.0/ProjetoIntegradorFerraz
   ```

2. **Configure o banco de dados:**
   - Crie um banco de dados MySQL chamado `ferrazconecta`
   - Importe as tabelas usando os scripts SQL fornecidos acima
   - Atualize as credenciais em `Php/database.php` se necessário

3. **Inicie o servidor PHP:**
   ```bash
   # Usando o servidor embutido do PHP (pasta Php/)
   cd Php
   php -S localhost:8000
   ```

4. **Acesse a aplicação:**
   - Abra seu navegador e acesse: `http://localhost:8000/index.php`

---

## 🔒 Recursos de Segurança

### ⚠️ Vulnerabilidades Conhecidas (IMPORTANTE!)

O código atual **não é seguro para produção**. Existem vulnerabilidades críticas:

1. **SQL Injection**: Senhas e dados são inseridos diretamente sem sanitização
   ```php
   // ❌ INSEGURO - Nunca faça assim em produção
   $sqlquery = mysqli_query($conexao, "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'");
   ```

2. **Armazenamento de Senhas em Texto Plano**: Senhas não são criptografadas
   ```php
   // ❌ INSEGURO - Use hash com bcrypt ou argon2
   $sql = "INSERT INTO cadastro (...) VALUES ('...', '$senha')";
   ```

### ✅ Recomendações para Produção

- [ ] Use **prepared statements** (MySQLi ou PDO)
- [ ] Implemente **bcrypt** ou **Argon2** para hash de senhas
- [ ] Adicione **validação e sanitização** de inputs
- [ ] Configure **HTTPS** (SSL/TLS)
- [ ] Implemente **CSRF tokens** em formulários
- [ ] Use **rate limiting** para login
- [ ] Adicione **2FA** (autenticação de dois fatores)

---

## 📱 Design Responsivo

O projeto utiliza **CSS Grid** e **Flexbox** para garantir responsividade:

- **Mobile-First**: Desenvolvido pensando em dispositivos móveis
- **Breakpoints**: Suporte para telas pequenas, médias e grandes
- **Variáveis CSS**: Facilita manutenção de cores e espaçamentos

```css
:root {
  --cor-primaria: #007bff;
  --cor-hover: #0056b3;
  --header-height: 70px;
  --gap: 1rem;
  /* ... mais variáveis */
}
```

---

## 🎨 Páginas Disponíveis

| Página | Arquivo | Descrição |
|--------|---------|-----------|
| Início | `index.php` | Vagas em destaque e apresentação |
| Cadastro | `cadastrar.php` | Formulário de registro de usuário |
| Login | `entrar.php` | Formulário de autenticação |
| Perfil | `perfil.php` | Dados do usuário autenticado |
| Empresas | `empresas.php` | Listagem de empresas parceiras |
| Vagas | `vagas.php` | Todas as vagas disponíveis |
| Sobre | `sobre.php` | Informações sobre o portal |

---

## 🔄 Fluxo de Autenticação

```
┌─────────────────┐
│  Página Login   │
│ (entrar.php)    │
└────────┬────────┘
         │ POST
         ▼
┌─────────────────────────────────┐
│  Processar Login (login.php)    │
│  - Valida credenciais           │
│  - Cria SESSION                 │
└────────┬────────────────────────┘
         │ 
    Sucesso │         Erro
         │              │
         ▼              ▼
    index.php    entrar.php
                 + Alert
```

---

## 📊 Estrutura de Dados

### Fluxo de Cadastro
1. Usuário preenche `cadastrar.php`
2. Dados são enviados via POST para `cadastro.php`
3. Inserção no banco de dados
4. Redirecionamento para `entrar.php`

### Fluxo de Login
1. Usuário insere credenciais em `entrar.php`
2. Validação em `login.php`
3. Criação de `$_SESSION` com dados do usuário
4. Redirecionamento para `index.php`

---

## 🐛 Troubleshooting

### Erro: "Falha ao conectar ao banco de dados"
- Verifique se MySQL está ativo
- Confirme as credenciais em `database.php`
- Certifique-se de que o banco `ferrazconecta` existe

### Erro: "Tabela não encontrada"
- Execute os scripts SQL fornecidos
- Verifique o nome do banco de dados

### Login não funciona
- Verifique se a sessão está habilitada em `php.ini`
- Confirme que os dados foram inseridos na tabela `cadastro`

---

## 🔄 Próximas Melhorias

- [ ] Implementar segurança contra SQL Injection
- [ ] Adicionar autenticação via Google/Apple (OAuth)
- [ ] Criar painel administrativo completo
- [ ] Adicionar filtros e busca avançada de vagas
- [ ] Implementar notificações por email
- [ ] Adicionar favoritos de vagas
- [ ] Gerar relatórios de candidaturas
- [ ] Integração com APIs de geolocalização

---

## 👥 Contribuição

Encontrou um bug? Tem sugestões de melhorias? Abra uma **issue** ou envie um **pull request**!

### Diretrizes:
1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está licenciado sob a **MIT License** - veja o arquivo [LICENSE](LICENSE) para detalhes.

---

## 📞 Contato e Suporte

- **Desenvolvedores**: Yuri Sales, Felipe Sales, Felipe Schueller e Nayara Bastos. 
- **GitHub**: [@YuriSalesJs](https://github.com/YuriSalesJs)
- **Email**: contato@ferrazconecta.com.br

---

## 🎯 Status do Projeto

```
Status: 🔧 Em Desenvolvimento
Versão: 2.0 Beta
Última Atualização: Dezembro 2025
```

---

**Última atualização**: Dezembro 8, 2025
