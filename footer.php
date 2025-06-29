<footer class="rodape" role="contentinfo">
    <div class="rodape-div">
      <address class="footer-contact">
        <img src="Img/logo_azul.png" alt="Logo Ferraz" width="100" class="logo_f">
        <p>Rua Carlos de Carvalho, 200 - Jardim Sao João<br>Ferraz de Vasconcelos – SP</p>
      </address>
      <nav class="footer-nav" aria-label="Links úteis">
        <ul>
          <li><a href="index.php">Página Inicial</a></li>
          <li><a href="sobre.php">Sobre</a></li>
          <li><a href="cadastrar_empresa.php">Deseja cadastrar sua empresa?</a></li>
          <li><a href="entrar_empresa.php">Deseja logar como empresa?</a></li>
        </ul>
      </nav>
    </div>
    <p class="rodape-direitos">© 2025 FATEC Ferraz de Vasconcelos — Todos os direitos reservados.</p>
</footer>

<script>
  (function() {
    // Busca o botão no HTML
    const toggleButton = document.getElementById('modo-escuro-toggle');
    const body = document.body;
    const themeKey = 'theme';

    // --- NOSSA NOVA VERIFICAÇÃO ---
    if (toggleButton) {
      // Se o botão foi encontrado, exibe uma mensagem de sucesso no console
      console.log('SUCESSO: Botão de modo escuro foi encontrado no HTML.');
      toggleButton.addEventListener('click', toggleTheme);
    } else {
      // Se o botão NÃO foi encontrado, exibe um erro claro e específico
      console.error('ERRO CRÍTICO: Não foi possível encontrar o elemento com id="modo-escuro-toggle". Verifique se o "id" no botão em navbar.php está escrito exatamente igual.');
    }
    // --- FIM DA VERIFICAÇÃO ---

    function applyTheme(theme) {
      if (theme === 'dark') {
        body.classList.add('dark-mode');
      } else {
        body.classList.remove('dark-mode');
      }
      localStorage.setItem(themeKey, theme);
    }

    function toggleTheme() {
      if (body.classList.contains('dark-mode')) {
        applyTheme('light');
      } else {
        applyTheme('dark');
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      const savedTheme = localStorage.getItem(themeKey);
      if (savedTheme) {
        applyTheme(savedTheme);
      } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          applyTheme('dark');
        } else {
          applyTheme('light');
        }
      }
    });
  })();
</script>

</script> <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>


</body>
</html>