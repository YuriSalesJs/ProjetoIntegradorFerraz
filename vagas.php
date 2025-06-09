<!-- vagas.php -->
 <?php include "navbar.php"; include "database.php"; ?>
  <main>
    <section aria-labelledby="empresas-titulo">
      <h2 id="empresas-titulo">Vagas</h2>
      <div class="cards-container">
        
        <?php
            // 1. Prepara e executa a consulta para buscar as vagas no banco de dados.
            $sql_vagas = "SELECT * FROM vagas ORDER BY id DESC"; // Ordena pelas mais recentes
            $resultado = mysqli_query($conexao, $sql_vagas);

            // 2. Verifica se encontrou alguma vaga.
            if (mysqli_num_rows($resultado) > 0) {
                
                // 3. Se encontrou, inicia o loop para criar um card para cada vaga.
                while ($vaga = mysqli_fetch_assoc($resultado)) {
                    // O HTML do card é montado dinamicamente com os dados da variável $vaga
                    echo "<article class='card'>";
                    echo "<h3>" . htmlspecialchars($vaga['titulo']) . "</h3>";
                    echo "<ul class='details'>";
                    echo "<li><strong>Salário:</strong> " . htmlspecialchars($vaga['salario']) . "</li>";
                    echo "<li><strong>Experiência:</strong> " . htmlspecialchars($vaga['exp']) . "</li>";
                    echo "<li><strong>Escolaridade:</strong> " . htmlspecialchars($vaga['escolaridade']) . "</li>";
                    echo "<li><strong>Localização:</strong> " . htmlspecialchars($vaga['localizacao']) . "</li>";
                    echo "<li><strong>Sexo:</strong> " . htmlspecialchars($vaga['sexo']) . "</li>";
                    echo "</ul>";
                    echo "<a href='detalhes_vaga.php?id=" . $vaga['id'] . "' class='btn'>Ver mais</a>";
                    echo "</article>";
                }

            } else {
                // 4. Se não encontrou nenhuma vaga, exibe uma mensagem.
                echo "<p>Nenhuma vaga encontrada no sistema no momento.</p>";
            }
        ?>

      </div>
    </section>
  </main>
<?php include "footer.php"; ?>
