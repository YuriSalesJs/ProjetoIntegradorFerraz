<?php
$title = 'Empresas - Ferraz Conecta';
?>

<section class="search-section">
    <div class="container">
        <h1 class="page-title">Empresas Parceiras</h1>
        <p class="page-subtitle">Conheça as empresas que fazem parte do Ferraz Conecta e oferecem oportunidades em nossa cidade.</p>
        
        <form action="/empresas" method="get" class="search-form">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" placeholder="Digite o nome da empresa ou palavra-chave" value="<?= htmlspecialchars($busca ?? '') ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar Empresas
                </button>
            </div>
        </form>
    </div>
</section>

<div class="cards-container">
    <?php if (!empty($empresas)): ?>
        <?php foreach ($empresas as $empresa): ?>
            <div class="empresa-card">
                <div class="empresa-header">
                    <h3><?= htmlspecialchars($empresa['razao_social']) ?></h3>
                    <span class="empresa-badge">
                        <i class="fas fa-building"></i> Empresa
                    </span>
                </div>

                <ul class="empresa-info">
                    <li><strong>Email:</strong> <?= htmlspecialchars($empresa['email']) ?></li>
                    <li><strong>Telefone:</strong> <?= htmlspecialchars($empresa['telefone']) ?></li>
                    <li><strong>CNPJ:</strong> <?= htmlspecialchars($empresa['cnpj']) ?></li>
                    <li><strong>Endereço:</strong> <?= htmlspecialchars($empresa['endereco']) ?></li>
                </ul>

                <?php if ($empresa['descricao']): ?>
                    <div class="empresa-descricao">
                        <?= htmlspecialchars(substr($empresa['descricao'], 0, 150)) ?><?= strlen($empresa['descricao']) > 150 ? '...' : '' ?>
                    </div>
                <?php endif; ?>

                <div class="mt-3">
                    <a href="/empresas/<?= $empresa['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Ver Detalhes
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-results">
            <?php if (!empty($busca)): ?>
                <p>Nenhuma empresa encontrada para a busca: <strong>"<?= htmlspecialchars($busca) ?>"</strong>.</p>
                <p><a href="/empresas" class="btn btn-primary">Ver todas as empresas</a></p>
            <?php else: ?>
                <p>Nenhuma empresa cadastrada no sistema no momento.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<div class="text-center mt-4">
    <a href="/" class="btn btn-outline-primary">
        <i class="fas fa-home"></i> Página Inicial
    </a>
    <a href="/vagas" class="btn btn-outline-secondary">
        <i class="fas fa-briefcase"></i> Ver Vagas
    </a>
</div> 