<?php
$title = 'Ferraz Conecta - Página Inicial';
?>

<div id="meuCarrossel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#meuCarrossel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2070&auto=format&fit=crop" alt="Pessoas em reunião de trabalho">
            <div class="carousel-caption">
                <h3>Bem-vindo ao Ferraz Conecta</h3>
                <p>A ponte direta entre os talentos da nossa cidade e as oportunidades de emprego.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1974&auto=format&fit=crop" alt="Profissionais colaborando em um escritório">
            <div class="carousel-caption">
                <h3>Empresas e Candidatos Conectados</h3>
                <p>Fortalecendo a economia local e valorizando nossos profissionais.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="/img/pexels-pixabay-279949.jpg" alt="Mão segurando uma lâmpada, simbolizando novas ideias e oportunidades">
            <div class="carousel-caption">
                <h3>Sua Próxima Oportunidade Começa Aqui</h3>
                <p>Cadastre-se e encontre a vaga ideal para você.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#meuCarrossel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#meuCarrossel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<section class="secao-sobre" id="estatisticas">
    <div class="estatisticas-container">
        <div class="estatistica-item">
            <div class="estatistica-numero"><?= $totalCandidatos ?></div>
            <div class="estatistica-label">Candidatos Cadastrados</div>
        </div>
        <div class="estatistica-item">
            <div class="estatistica-numero"><?= $totalEmpresas ?></div>
            <div class="estatistica-label">Empresas Parceiras</div>
        </div>
        <div class="estatistica-item">
            <div class="estatistica-numero"><?= $totalVagas ?></div>
            <div class="estatistica-label">Vagas Disponíveis</div>
        </div>
    </div>
</section>

<div class="container">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'candidatura_sucesso'): ?>
        <div class="alert alert-success">
            <strong>Parabéns!</strong> Sua candidatura foi realizada com sucesso. Boa sorte!
        </div>
    <?php endif; ?>
</div>

<section aria-labelledby="destaque">
    <h2 id="destaque" class="page-title">Vagas em Destaque</h2>
    <div class="cards-container">
        <?php if (!empty($vagasDestaque)): ?>
            <?php foreach ($vagasDestaque as $vaga): ?>
                <article class='card'>
                    <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
                    <ul class='details'>
                        <li><strong>Salário: R$ </strong> <?= htmlspecialchars($vaga['salario']) ?></li>
                        <li><strong>Localização:</strong> <?= htmlspecialchars($vaga['localizacao']) ?></li>
                    </ul>
                    <a href='/vagas/<?= $vaga['id'] ?>' class='btn btn-primary'>Ver mais</a>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>Nenhuma vaga encontrada no sistema no momento.</p>
            </div>
        <?php endif; ?>
    </div>
</section> 