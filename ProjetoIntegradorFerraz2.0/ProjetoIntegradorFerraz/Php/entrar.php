<?php include "navbar.php"; include 'database.php'; ?>
  <main>
    <div class="form-container">
      <div class="form-card">
        <h2>Digite seu e-mail</h2>
        <p class="form-subtitle">Continuar para Ferraz Conecta</p>
        <form action="login.php" method="post">
        <input type="email" placeholder="Digite seu e-mail" name="email" class="form-input">
        <input type="senha" placeholder="Digite sua senha" name="senha" class="form-input">

        <button class="btn btn-primary" type="submit">Entrar na sua conta ou criar uma</button>

        <div class="divider"><span>ou</span></div>

        <button class="btn btn-social">
          <img src="imagens/google-icon.svg" alt="" class="icon"> Continuar com Google
        </button>
        <button class="btn btn-social">
          <img src="imagens/apple-icon.svg" alt="" class="icon"> Continuar com Apple
        </button>

        <p class="form-legal">
          Ao continuar, você declara que concorda com os
          <a href="#">Termos do serviço</a> e com a
          <a href="#">Política de privacidade</a>.
        </p>
      </div>
    </div>
  </main>
<?php include "footer.php"; ?>