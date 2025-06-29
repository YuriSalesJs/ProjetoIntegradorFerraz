<?php
$title = 'Vagas - Ferraz Conecta';
?>

<section class="search-section">
    <div class="container">
        <h1 class="page-title">Nossas Vagas Abertas</h1>
        <p class="page-subtitle">Encontre a oportunidade ideal para você em Ferraz de Vasconcelos.</p>
        
        <form action="/vagas" method="get" class="search-form">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" placeholder="Digite o cargo ou palavra-chave" value="<?= htmlspecialchars($busca ?? '') ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar Vagas
                </button>
            </div>
        </form>
    </div>
</section>

<div class="cards-container">
    <?php if (!empty($vagas)): ?>
        <?php foreach ($vagas as $vaga): ?>
            <article class='card'>
                <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
                <ul class='details'>
                    <li><strong>Empresa:</strong> <?= htmlspecialchars($vaga['empresa_nome'] ?? 'Não informado') ?></li>
                    <li><strong>Salário:</strong> <?= $this->formatMoney($vaga['salario']) ?></li>
                    <li><strong>Localização:</strong> <?= htmlspecialchars($vaga['localizacao']) ?></li>
                    <li><strong>Experiência:</strong> <?= htmlspecialchars($vaga['exp']) ?></li>
                    <li><strong>Escolaridade:</strong> <?= htmlspecialchars($vaga['escolaridade']) ?></li>
                    <li><strong>Data da Postagem:</strong> <?= date('d/m/Y', strtotime($vaga['data_postagem'])) ?></li>
                </ul>
                <a href='/vagas/<?= $vaga['id'] ?>' class='btn btn-primary'>Ver mais</a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-results">
            <?php if (!empty($busca)): ?>
                <p>Nenhuma vaga encontrada para a busca: <strong>"<?= htmlspecialchars($busca) ?>"</strong>.</p>
                <p><a href="/vagas" class="btn btn-primary">Ver todas as vagas</a></p>
            <?php else: ?>
                <p>Nenhuma vaga cadastrada no sistema no momento.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div> 