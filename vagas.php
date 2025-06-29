<?php include "navbar.php"; include "database.php"; ?>
<main>
    <section aria-labelledby="vagas-titulo" style="padding: 1rem 2rem;">
      <h2 id="vagas-titulo" style="text-align: center;">Nossas Vagas Abertas</h2>
      <p style="text-align: center;">Encontre a oportunidade ideal para você em Ferraz de Vasconcelos.</p>
      <hr>

      <form action="vagas.php" method="get" class="form-inline" style="margin-bottom: 2rem; text-align: center;">
        <div class="form-group">
            <input type="text" name="busca" class="form-control" placeholder="Digite o cargo ou palavra-chave" style="width: 300px; max-width: 100%;" value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Buscar Vagas</button>
      </form>
      <div class="cards-container">
        
        <?php
            // PASSO 2: Lógica PHP atualizada para filtrar os resultados
            
            $sql_base = "SELECT * FROM vagas";
            $params = [];
            $types = '';

            // Verifica se um termo de busca foi enviado pela URL
            if (!empty($_GET['busca'])) {
                $termo_busca = '%' . $_GET['busca'] . '%'; // Prepara o termo para o LIKE
                
                // Adiciona a condição WHERE na consulta para buscar no título OU na descrição
                $sql_base .= " WHERE titulo LIKE ? OR descricao_completa LIKE ?";
                
                $params[] = $termo_busca;
                $params[] = $termo_busca;
                $types .= 'ss'; // Dois parâmetros do tipo string (s)
            }

            $sql_base .= " ORDER BY data_postagem DESC"; // Ordena pelas mais recentes

            // Prepara e executa a consulta de forma segura
            $stmt = mysqli_prepare($conexao, $sql_base);
            if (!empty($params)) {
                mysqli_stmt_bind_param($stmt, $types, ...$params);
            }
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            // Exibe os resultados ou uma mensagem de "não encontrado"
            if (mysqli_num_rows($resultado) > 0) {
                while ($vaga = mysqli_fetch_assoc($resultado)) {
                    // O HTML do card continua o mesmo que você já tinha
                    echo "<article class='card'>";
                    echo "<h3>" . htmlspecialchars($vaga['titulo']) . "</h3>";
                    echo "<ul class='details'>";
                    echo "<li><strong>Salário: R$ </strong> " . htmlspecialchars($vaga['salario']) .",00". "</li>";
                    echo "<li><strong>Experiência:</strong> " . htmlspecialchars($vaga['exp']) . "</li>";
                    echo "<li><strong>Escolaridade:</strong> " . htmlspecialchars($vaga['escolaridade']) . "</li>";
                    echo "<li><strong>Localização:</strong> " . htmlspecialchars($vaga['localizacao']) . "</li>";
                    echo "<li><strong>Sexo:</strong> " . htmlspecialchars($vaga['sexo']) . "</li>";
                    echo "</ul>";
                    echo "<a href='detalhes_vaga.php?id=" . $vaga['id'] . "' class='btn btn-primary'>Ver mais</a>";
                    echo "</article>";
                }
            } else {
                // Mensagem personalizada se a busca não retornar resultados
                if (!empty($_GET['busca'])) {
                    echo "<p style='text-align:center; width:100%;'>Nenhuma vaga encontrada para a busca: <strong>\"" . htmlspecialchars($_GET['busca']) . "\"</strong>.</p>";
                } else {
                    // Mensagem padrão se não houver vagas no sistema
                    echo "<p style='text-align:center; width:100%;'>Nenhuma vaga cadastrada no sistema no momento.</p>";
                }
            }
            mysqli_stmt_close($stmt);
        ?>

      </div>
    </section>
</main>
<?php include "footer.php"; ?>
