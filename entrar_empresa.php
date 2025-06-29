<?php include "navbar.php"; ?>
<main>
    <div class="form-container">
      <div class="form-card">

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'login_invalido'): ?>
            <div class="alert alert-danger">E-mail ou senha inválidos. Tente novamente.</div>
        <?php elseif($_GET['status'] == 'cadastro_sucesso'): ?>
            <div class="alert alert-success">Cadastro realizado com sucesso! Faça o login para continuar.</div>
        <?php elseif($_GET['status'] == 'erro_cadastro'): ?>
            <div class="alert alert-danger">Ocorreu um erro ao realizar o cadastro. Verifique se o CNPJ ou e-mail já não estão em uso.</div>
        <?php endif; ?>
    <?php endif; ?>

        <h2>Login da Empresa</h2>
        <p class="form-subtitle">Acesse seu painel para gerenciar vagas</p>
        <form action="login_empresa.php" method="post">
          <input type="email" placeholder="Digite seu e-mail de login" name="email" class="form-input" required>
          <input type="password" placeholder="Digite sua senha" name="senha" class="form-input" required>
          <button class="btn btn-primary" type="submit">Entrar</button>
        </form>
      </div>
    </div>
</main>
<?php include "footer.php"; ?>