<?php
$title = htmlspecialchars($empresa['razao_social']) . ' - Ferraz Conecta';


?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="empresa-detalhes">
                <div class="empresa-header">
                    <h1><?= htmlspecialchars($empresa['razao_social']) ?></h1>
                    <span class="empresa-badge">
                        <i class="fas fa-building"></i> Empresa Parceira
                    </span>
                </div>

                <div class="empresa-content">
                    <div class="empresa-info-grid">
                        <div class="empresa-info-item">
                            <h5><i class="fas fa-envelope"></i> Contato</h5>
                            <p><?= htmlspecialchars($empresa['email']) ?></p>
                        </div>
                        <div class="empresa-info-item">
                            <h5><i class="fas fa-phone"></i> Telefone</h5>
                            <p><?= htmlspecialchars($empresa['telefone']) ?></p>
                        </div>
                        <div class="empresa-info-item">
                            <h5><i class="fas fa-id-card"></i> CNPJ</h5>
                            <p><?= htmlspecialchars($empresa['cnpj']) ?></p>
                        </div>
                        <div class="empresa-info-item">
                            <h5><i class="fas fa-map-marker-alt"></i> Localização</h5>
                            <p><?= htmlspecialchars($empresa['endereco']) ?></p>
                        </div>
                    </div>

                    <?php if ($empresa['descricao']): ?>
                        <div class="empresa-descricao">
                            <h5><i class="fas fa-info-circle"></i> Sobre a Empresa</h5>
                            <?= nl2br(htmlspecialchars($empresa['descricao'])) ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-muted small">
                        <i class="fas fa-calendar"></i> 
                        Cadastrada em: <?= isset($empresa['created_at']) ? date('d/m/Y', strtotime($empresa['created_at'])) : 'Data não disponível' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ações</h5>
                    
                    <div class="d-grid gap-2">
                        <a href="/vagas?empresa=<?= $empresa['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-briefcase"></i> Ver Vagas da Empresa
                        </a>
                        
                        <?php if ($this->isLoggedIn() && $this->getSession('user_type') === 'candidato'): ?>
                            <a href="/vagas" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i> Procurar Vagas
                            </a>
                        <?php elseif (!$this->isLoggedIn()): ?>
                            <a href="/login" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt"></i> Fazer Login
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="vagas-empresa">
                <div class="vagas-header">
                    <h5><i class="fas fa-briefcase"></i> Vagas Disponíveis</h5>
                </div>
                
                <?php if (!empty($vagas)): ?>
                    <?php foreach (array_slice($vagas, 0, 5) as $vaga): ?>
                        <div class="vaga-item">
                            <h6><?= htmlspecialchars($vaga['titulo']) ?></h6>
                            <div class="vaga-meta">
                                <span class="vaga-salario"><?= $this->formatMoney($vaga['salario']) ?></span>
                                <span class="vaga-localizacao"><?= htmlspecialchars($vaga['localizacao']) ?></span>
                            </div>
                            <a href="/vagas/<?= $vaga['id'] ?>" class="btn btn-sm btn-outline-primary mt-2">
                                Ver Vaga
                            </a>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (count($vagas) > 5): ?>
                        <div class="text-center p-3">
                            <a href="/vagas?empresa=<?= $empresa['id'] ?>" class="btn btn-outline-primary btn-sm">
                                Ver todas as <?= count($vagas) ?> vagas
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="p-3 text-center">
                        <p class="text-muted mb-0">Nenhuma vaga disponível no momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/empresas" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar às Empresas
        </a>
        <a href="/" class="btn btn-outline-primary">
            <i class="fas fa-home"></i> Página Inicial
        </a>
    </div>
</div> 