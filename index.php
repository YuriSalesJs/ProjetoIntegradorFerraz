<?php include "navbar.php"; include "database.php"; ?>
<main>

    <div id="meuCarrossel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#meuCarrossel" data-slide-to="0" class="active"></li>
            <li data-target="#meuCarrossel" data-slide-to="1"></li>
            <li data-target="#meuCarrossel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2070&auto=format&fit=crop" alt="Pessoas em reunião de trabalho">
                <div class="carousel-caption">
                    <h3>Bem-vindo ao Ferraz Conecta</h3>
                    <p>A ponte direta entre os talentos da nossa cidade e as oportunidades de emprego.</p>
                </div>
            </div>

            <div class="item">
                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1974&auto=format&fit=crop" alt="Profissionais colaborando em um escritório">
                <div class="carousel-caption">
                    <h3>Empresas e Candidatos Conectados</h3>
                    <p>Fortalecendo a economia local e valorizando nossos profissionais.</p>
                </div>
            </div>

            <div class="item">
                <img src="Img/pexels-pixabay-279949.jpg" alt="Mão segurando uma lâmpada, simbolizando novas ideias e oportunidades">
                <div class="carousel-caption">
                    <h3>Sua Próxima Oportunidade Começa Aqui</h3>
                    <p>Cadastre-se e encontre a vaga ideal para você.</p>
                </div>
            </div>
        </div>

        <a class="left carousel-control" href="#meuCarrossel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#meuCarrossel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    <section class="secao-sobre" id="estatisticas">
        <?php
            // Busca o total de candidatos
            $query_candidatos = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM cadastro");
            $total_candidatos = mysqli_fetch_assoc($query_candidatos)['total'];

            // Busca o total de empresas
            $query_empresas = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM empresas");
            $total_empresas = mysqli_fetch_assoc($query_empresas)['total'];

            // Busca o total de vagas
            $query_vagas = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM vagas");
            $total_vagas = mysqli_fetch_assoc($query_vagas)['total'];
        ?>
        <div class="estatisticas-container">
            <div class="estatistica-item">
                <div class="estatistica-numero"><?php echo $total_candidatos; ?></div>
                <div class="estatistica-label">Candidatos Cadastrados</div>
            </div>
            <div class="estatistica-item">
                <div class="estatistica-numero"><?php echo $total_empresas; ?></div>
                <div class="estatistica-label">Empresas Parceiras</div>
            </div>
            <div class="estatistica-item">
                <div class="estatistica-numero"><?php echo $total_vagas; ?></div>
                <div class="estatistica-label">Vagas Disponíveis</div>
            </div>
        </div>
    </section>
    <div class="container" style="padding-top: 1rem;">
        <?php if(isset($_GET['status']) && $_GET['status'] == 'candidatura_sucesso'): ?>
            <div class="alert alert-success">
                <strong>Parabéns!</strong> Sua candidatura foi realizada com sucesso. Boa sorte!
            </div>
        <?php endif; ?>
    </div>
    <section aria-labelledby="destaque">
      <h2 id="destaque">Vagas em Destaque</h2>
      <div class="cards-container">
        <?php
            $sql_vagas_destaque = "SELECT * FROM vagas ORDER BY id DESC LIMIT 8";
            $resultado_vagas_destaque = mysqli_query($conexao, $sql_vagas_destaque);
            if (mysqli_num_rows($resultado_vagas_destaque) > 0) {
                while ($vaga = mysqli_fetch_assoc($resultado_vagas_destaque)) {
                    echo "<article class='card'>";
                    echo "<h3>" . htmlspecialchars($vaga['titulo']) . "</h3>";
                    echo "<ul class='details'>";
                    echo "<li><strong>Salário: R$ </strong> " . htmlspecialchars($vaga['salario']) . "</li>";
                    echo "<li><strong>Localização:</strong> " . htmlspecialchars($vaga['localizacao']) . "</li>";
                    echo "</ul>";
                    echo "<a href='detalhes_vaga.php?id=" . $vaga['id'] . "' class='btn btn-primary'>Ver mais</a>";
                    echo "</article>";
                }
            } else {
                echo "<p>Nenhuma vaga encontrada no sistema no momento.</p>";
            }
        ?>
      </div>
    </section>
</main>
<?php include "footer.php"; ?>