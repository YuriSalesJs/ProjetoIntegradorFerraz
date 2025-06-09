<?php include "navbar.php"; ?>
<main>
    <div class="form-container">
      <div class="form-card" style="max-width: 600px;">
        <h2>Cadastro de Empresa</h2>
        <p class="form-subtitle">Divulgue suas vagas e encontre os melhores talentos locais</p>

        <form action="processa_cadastro_empresa.php" method="post" style="text-align: left;">
          <label for="nome_fantasia">Nome Fantasia:</label>
          <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-input" required>

          <label for="cnpj">CNPJ:</label>
          <input type="text" id="cnpj" name="cnpj" class="form-input" required>
          
          <label for="ramo_atividade">Ramo de Atividade:</label>
          <input type="text" id="ramo_atividade" name="ramo_atividade" class="form-input">

          <label for="email_contato">E-mail de Contato (Público):</label>
          <input type="email" id="email_contato" name="email_contato" class="form-input" required>
          
          <hr style="margin: 1.5rem 0;">
          <p class="form-subtitle" style="text-align:center;">Crie seus dados de acesso</p>

          <label for="email_login">E-mail de Login (Privado):</label>
          <input type="email" id="email_login" name="email_login" class="form-input" required>

          <label for="senha">Senha:</label>
          <input type="password" id="senha" name="senha" class="form-input" required>

          <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Criar Cadastro da Empresa</button>
        </form>
      </div>
    </div>
</main>
<?php include "footer.php"; ?>