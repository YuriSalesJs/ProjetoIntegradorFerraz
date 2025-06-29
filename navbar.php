<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ferraz Conecta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="Img/1d36c50b-6f7c-4ab0-ad84-9db41b089495.png">
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="Css/style.css">

</head>
<body>

<body>
<?php $paginaAtual = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-inverse">


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="" target="_blank"><img src="Img/logo_azul.png" alt="Logo Ferraz Conecta" class="logo_f" ></a>
    </div>
    <ul class="nav navbar-nav">
        <li <?php echo ($paginaAtual == 'index.php') ? 'class="active"' : ''; ?>>
            <a href="index.php">Página Inicial</a>
        </li>
        <li <?php echo ($paginaAtual == 'vagas.php' || $paginaAtual == 'detalhes_vaga.php') ? 'class="active"' : ''; ?>>
            <a href="vagas.php">Vagas</a>
        </li>
        <li <?php echo ($paginaAtual == 'empresas.php' || $paginaAtual == 'detalhes_empresa.php') ? 'class="active"' : ''; ?>>
            <a href="empresas.php">Empresas</a>
        </li>
        <li <?php echo ($paginaAtual == 'sobre.php') ? 'class="active"' : ''; ?>>
            <a href="sobre.php">Sobre</a>
        </li>
    </ul>

    <div class="navbar-right" style="margin: 8px 15px 0 0;">
        <button id="modo-escuro-toggle" class="btn btn-default" style="background-color: #444; border-color: #555;" title="Alternar modo claro/escuro">
            <span class="glyphicon glyphicon-adjust" style="color: #fff;"></span>
        </button>
    </div>
    
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['tipo_usuario'])) {
        if ($_SESSION['tipo_usuario'] == 'candidato') {
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="minhas_candidaturas.php"><span class="glyphicon glyphicon-list-alt"></span> Minhas Candidaturas</a></li>';
            echo '<li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> ' . htmlspecialchars($_SESSION['nome_usuario']) . '</a></li>';
            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
            echo '</ul>';
        } 
        elseif ($_SESSION['tipo_usuario'] == 'empresa') {
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '<li><a href="painel_empresa.php"><span class="glyphicon glyphicon-briefcase"></span> ' . htmlspecialchars($_SESSION['nome_fantasia']) . '</a></li>';
            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>';
            echo '</ul>';
        }
    } else {
        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li><a href="cadastrar.php"><span class="glyphicon glyphicon-user"></span> Cadastrar</a></li>';
        echo '<li><a href="entrar.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
        echo '</ul>';
    }
    ?>
      
  </div>
</nav>