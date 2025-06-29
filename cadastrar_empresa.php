<?php include "navbar.php"; ?>
<main>
    <div class="form-container">
      <div class="form-card" style="max-width: 600px;">

        <?php if(isset($_GET['status']) && $_GET['status'] == 'erro_cadastro'): ?>
            <div class="alert alert-danger">Ocorreu um erro. Verifique se o CNPJ ou e-mail já não estão em uso.</div>
        <?php endif; ?>

        <h2>Cadastro de Empresa</h2>
        <p class="form-subtitle">Divulgue suas vagas e encontre os melhores talentos locais</p>

        <form action="processa_cadastro_empresa.php" method="post" style="text-align: left;">
          <label for="nome_fantasia">Nome Fantasia:</label>
          <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-input" required>

          <label for="cnpj">CNPJ:</label>
          <input type="text" id="cnpj" name="cnpj" class="form-input" required>
          
          <label for="ramo_atividade">Ramo de Atividade:</label>
          <input type="text" id="ramo_atividade" name="ramo_atividade" class="form-input">

          <label for="email">E-mail (será usado para contato e login):</label>
          <input type="email" id="email" name="email" class="form-input" required>
          
          <label for="senha">Senha:</label>
          <input type="password" id="senha" name="senha" class="form-input" required>

          <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Criar Cadastro da Empresa</button>
        </form>
      </div>
    </div>
</main>
<?php include "footer.php"; ?>