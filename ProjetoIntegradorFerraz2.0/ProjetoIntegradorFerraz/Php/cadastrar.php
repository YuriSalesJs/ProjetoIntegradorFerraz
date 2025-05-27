<?php include "navbar.php"; include "database.php"; ?>
  <main>
    <div class="form-container">
      <div class="form-card">
        <h2>Cadastro de Usuário</h2>
        <p class="form-subtitle">Abra sua conta grátis</p>

        <form action="cadastro.php" method="post">
          <input type="text"    class="form-input" placeholder="Nome completo"    name="nome" required>
          <input type="email"   class="form-input" placeholder="E-mail"          name="email" required>
          <input type="tel"     class="form-input" placeholder="Telefone"       name="telefone">
          <input type="text"    class="form-input" placeholder="CPF"             name="cpf" maxlength="14" required>
          <input type="date"    class="form-input" placeholder="Data de nascimento" name="nascimento" required>
          <input type="password"class="form-input" placeholder="Senha"           name="senha" required>
          <input type="password"class="form-input" placeholder="Confirmar senha" name="confsenha" required>

          <div class="form-group checkbox">
            <input type="checkbox" id="termos" name="termos" required>
            <label for="termos">Li e aceito os <a href="#">termos de uso</a></label>
          </div>

          <button type="submit" class="btn btn-primary">Criar conta</button>
        </form>

        <p class="form-legal">
          Ao continuar, você declara que concorda com os
          <a href="#">Termos do serviço</a> e com a
          <a href="#">Política de privacidade</a>.
        </p>
      </div>
    </div>
  </main>
<?php include "footer.php"; ?>