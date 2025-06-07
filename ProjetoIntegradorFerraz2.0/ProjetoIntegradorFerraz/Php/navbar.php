<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ferraz Conecta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- jQuery e Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Seu CSS -->
  <link rel="stylesheet" href="../Css/Style.css">
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="https://ferrazdevasconcelos.sp.gov.br/web/" target="_blank">
          <img src="../img/cropped-LOGO_FERRAZ-2048x845.png" alt="Logo Ferraz" class="logo_f">
        </a>
      </div>

      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Página Inicial</a></li>
        <li><a href="vagas.php">Vagas</a></li>
        <li><a href="empresas.php">Empresas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="index_.php" id="toggle-theme" title="Modo Escuro">
            <i class="fa fa-moon"></i>
          </a>
        </li>
        <?php
          session_start();
          if (isset($_SESSION['nome'])): ?>
            <li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['nome']; ?></a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
          <?php else: ?>
            <li><a href="cadastrar.php"><span class="glyphicon glyphicon-user"></span> Cadastrar</a></li>
            <li><a href="entrar.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif; ?>

        
      </ul>
    </div>
  </nav>