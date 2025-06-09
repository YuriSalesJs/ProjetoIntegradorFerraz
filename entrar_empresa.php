<?php include "navbar.php"; ?>
<main>
    <div class="form-container">
      <div class="form-card">
        <h2>Login da Empresa</h2>
        <p class="form-subtitle">Acesse seu painel para gerenciar vagas</p>
        <form action="login_empresa.php" method="post">
          <input type="email" placeholder="Digite seu e-mail de login" name="email_login" class="form-input" required>
          <input type="password" placeholder="Digite sua senha" name="senha" class="form-input" required>
          <button class="btn btn-primary" type="submit">Entrar</button>
        </form>
      </div>
    </div>
</main>
<?php include "footer.php"; ?>