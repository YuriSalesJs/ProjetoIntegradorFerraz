<?php include "navbar.php"; include "database.php"; ?>

<main class="container">
  <section aria-labelledby="empresas-titulo" style="margin-top: 20px;">
    <h2 id="empresas-titulo">Empresas Parceiras</h2>
    <p>Conheça as empresas que oferecem vagas em nossa plataforma.</p>
    <hr>

    <div class="cards-container">

      <?php
        // 1. Prepara e executa a consulta para buscar as empresas
        $sql_empresas = "SELECT * FROM empresas ORDER BY nome_fantasia ASC";
        $resultado = mysqli_query($conexao, $sql_empresas);

        // 2. Verifica se encontrou alguma empresa
        if (mysqli_num_rows($resultado) > 0) {
            
            // 3. Loop para exibir cada empresa em um card
            while ($empresa = mysqli_fetch_assoc($resultado)) {
                echo "<article class='card'>";
                echo "<h3>" . htmlspecialchars($empresa['nome_fantasia']) . "</h3>";
                echo "<ul class='details'>";
                echo "<li><strong>Ramo:</strong> " . htmlspecialchars($empresa['ramo_atividade']) . "</li>";
                echo "<li><strong>Telefone:</strong> " . htmlspecialchars($empresa['telefone']) . "</li>";
                echo "<li><strong>E-mail:</strong> " . htmlspecialchars($empresa['email_contato']) . "</li>";
                echo "</ul>";
                // O link agora leva para uma futura página de detalhes da empresa
                echo "<a href='detalhes_empresa.php?id=" . $empresa['id'] . "' class='btn'>Ver Perfil</a>";
                echo "</article>";
            }

        } else {
            // 4. Mensagem para quando não há empresas cadastradas
            echo "<p>Nenhuma empresa cadastrada no momento.</p>";
        }
      ?>
      
    </div>
    
  </section>
</main>

<?php include "footer.php"; ?>