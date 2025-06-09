<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ferraz Conecta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="Css/style.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="https://ferrazdevasconcelos.sp.gov.br/web/" target="_blank"><img src="Img/cropped-LOGO_FERRAZ-2048x845.png" alt="Logo Ferraz" class="logo_f" ></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Página Inicial</a></li>
      <li><a href="vagas.php">Vagas</a></li>
      <li><a href="empresas.php">Empresas</a></li>
      <li><a href="sobre.php">Sobre</a></li>
    </ul>
    <?php
    // Inicia a sessão se ainda não tiver sido iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica se há um usuário logado e qual o tipo
    if (isset($_SESSION['tipo_usuario'])) {
        
        // CASO 1: O usuário é um CANDIDATO
        if ($_SESSION['tipo_usuario'] == 'candidato') {
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> ' . htmlspecialchars($_SESSION['nome_usuario']) . '</a></li>';
            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
            echo '</ul>';
        } 
        // CASO 2: O usuário é uma EMPRESA
        elseif ($_SESSION['tipo_usuario'] == 'empresa') {
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="painel_empresa.php"><span class="glyphicon glyphicon-briefcase"></span> ' . htmlspecialchars($_SESSION['nome_fantasia']) . '</a></li>';
            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
            echo '</ul>';
        }

    } else {
        // CASO 3: Ninguém está logado
        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li><a href="cadastrar.php"><span class="glyphicon glyphicon-user"></span> Cadastrar</a></li>';
        echo '<li><a href="entrar.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
        echo '</ul>';
    }
    ?>
      
    </ul> </div>
</nav>