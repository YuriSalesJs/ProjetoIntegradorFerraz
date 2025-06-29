<?php include "navbar.php"; include "database.php"; ?>

<main>
    <section aria-labelledby="empresas-titulo" style="padding: 1rem 2rem;">
      <h2 id="empresas-titulo" style="text-align: center;">Empresas Parceiras</h2>
      <p style="text-align: center;">Conheça as empresas que oferecem vagas em nossa plataforma.</p>
      <hr>

      <div class="cards-container">
        <?php
            // LÓGICA SIMPLIFICADA: Busca todas as empresas, sem filtro.
            $sql_empresas = "SELECT * FROM empresas ORDER BY nome_fantasia ASC";
            $resultado = mysqli_query($conexao, $sql_empresas);

            if (mysqli_num_rows($resultado) > 0) {
                while ($empresa = mysqli_fetch_assoc($resultado)) {
                    // O código para gerar os cards continua o mesmo
                    echo "<article class='card'>";
                    echo "<h3>" . htmlspecialchars($empresa['nome_fantasia']) . "</h3>";
                    echo "<ul class='details'>";
                    echo "<li><strong>Ramo:</strong> " . htmlspecialchars($empresa['ramo_atividade']) . "</li>";
                    echo "<li><strong>Telefone:</strong> " . htmlspecialchars($empresa['telefone']) . "</li>";
                    echo "<li><strong>E-mail:</strong> " . htmlspecialchars($empresa['email']) . "</li>";
                    echo "</ul>";
                    echo "<a href='detalhes_empresa.php?id=" . $empresa['id'] . "' class='btn btn-primary'>Ver Perfil</a>";
                    echo "</article>";
                }
            } else {
                echo "<p style='text-align:center; width:100%;'>Nenhuma empresa cadastrada no momento.</p>";
            }
        ?>
      </div>
    </section>
</main>

<?php include "footer.php"; ?>