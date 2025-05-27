<?php include "navbar.php"; include "database.php"; ?>
  <main>
    <section aria-labelledby="destaque">
      <h2 id="destaque">Vagas em Destaque</h2>
      <div class="cards-container">
        <!-- Exemplo de cartão; repetir via template/backend -->
        <?php $sqlquery2 = (mysqli_query($conexao, "SELECT * FROM vagas")); 
        echo "<article class='card'>";
          echo "<h3>Auxiliar de Limpeza</h3>";
          echo "<ul class='details'>";
            echo "<li><strong>Salário:</strong> R$1.717,12</li>";
            echo "<li><strong>Experiência:</strong> Não exige</li>";
            echo "<li><strong>Escolaridade:</strong> Fundamental completo</li>";
            echo "<li><strong>Idade:</strong> 20+</li>";
            echo "<li><strong>Sexo:</strong> Indiferente</li>";
          echo "</ul>";
          echo "<a href='#' class='btn'>Ver mais</a>";
        echo "</article>";
        ?>
        <!-- Outros cards... -->
      </div>
    </section>
  </main>
<?php include "footer.php"; ?>