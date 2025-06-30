# Ferraz Conecta - Sistema de Vagas

Sistema de vagas e candidatos para Ferraz de Vasconcelos, desenvolvido com arquitetura MVC e Composer.

## Estrutura do Projeto

```
ProjetoIntegradorFerraz/
├── app/                          # Código da aplicação
│   ├── Controllers/              # Controladores
│   │   ├── Controller.php        # Classe base dos controladores
│   │   ├── HomeController.php    # Controlador da página inicial
│   │   ├── AuthController.php    # Controlador de autenticação
│   │   ├── VagaController.php    # Controlador de vagas
│   │   ├── CandidatoController.php # Controlador de candidatos
│   │   └── EmpresaController.php # Controlador de empresas
│   ├── Models/                   # Modelos
│   │   ├── Database.php          # Classe de conexão com banco
│   │   ├── Model.php             # Classe base dos modelos
│   │   ├── Vaga.php              # Modelo de vagas
│   │   ├── Candidato.php         # Modelo de candidatos
│   │   └── Empresa.php           # Modelo de empresas
│   ├── Views/                    # Views
│   │   ├── layouts/              # Layouts
│   │   ├── partials/             # Componentes reutilizáveis
│   │   ├── home/                 # Views da página inicial
│   │   ├── auth/                 # Views de autenticação
│   │   ├── vagas/                # Views de vagas
│   │   ├── candidato/            # Views de candidatos
│   │   └── empresa/              # Views de empresas
│   └── Router.php                # Sistema de roteamento
├── config/                       # Configurações
│   └── database.php              # Configuração do banco de dados
├── public/                       # Arquivos públicos
│   ├── css/                      # Arquivos CSS
│   ├── js/                       # Arquivos JavaScript
│   ├── img/                      # Imagens
│   ├── .htaccess                 # Configuração do Apache
│   └── index.php                 # Ponto de entrada da aplicação
├── vendor/                       # Dependências do Composer
├── composer.json                 # Configuração do Composer
└── README.md                     # Este arquivo
```

## Instalação

1. **Clone o repositório:**
   ```bash
   git clone [url-do-repositorio]
   cd ProjetoIntegradorFerraz
   ```

2. **Instale as dependências do Composer:**
   ```bash
   composer install
   ```

3. **Configure o banco de dados:**
   - Edite o arquivo `config/database.php` com suas credenciais
   - Importe o banco de dados (estrutura disponível em `database.sql`)

4. **Configure o servidor web:**
   - Configure o DocumentRoot para a pasta `public/`
   - Certifique-se de que o mod_rewrite está habilitado

## Funcionalidades

### Para Candidatos:
- Cadastro e login
- Visualização de vagas
- Busca por vagas
- Candidatura em vagas
- Acompanhamento de candidaturas
- Edição de perfil

### Para Empresas:
- Cadastro e login
- Criação de vagas
- Edição de vagas
- Visualização de candidatos
- Gerenciamento de candidaturas
- Painel administrativo

## Rotas Principais

- `/` - Página inicial
- `/vagas` - Lista de vagas
- `/vagas/{id}` - Detalhes da vaga
- `/login` - Login de candidatos
- `/login-empresa` - Login de empresas
- `/cadastro` - Cadastro de candidatos
- `/cadastro-empresa` - Cadastro de empresas
- `/minhas-candidaturas` - Candidaturas do usuário
- `/painel-empresa` - Painel da empresa
- `/perfil` - Perfil do usuário

## Tecnologias Utilizadas

- **PHP 7.4+** - Linguagem de programação
- **Composer** - Gerenciador de dependências
- **PDO** - Acesso ao banco de dados
- **Bootstrap 5** - Framework CSS
- **Apache** - Servidor web
- **MySQL** - Banco de dados

## Arquitetura MVC

O projeto segue o padrão MVC (Model-View-Controller):

- **Models**: Responsáveis pela lógica de negócio e acesso aos dados
- **Views**: Responsáveis pela apresentação dos dados
- **Controllers**: Responsáveis por processar as requisições e coordenar Models e Views

## Desenvolvimento

Para contribuir com o projeto:

1. Faça um fork do repositório
2. Crie uma branch para sua feature
3. Implemente suas mudanças seguindo os padrões MVC
4. Teste suas alterações
5. Envie um pull request

## Licença

Este projeto está sob a licença MIT.

---

> Desenvolvido para a cidade de Ferraz de Vasconcelos – conectando pessoas e oportunidades locais.
