<?php
$title = htmlspecialchars($vaga['titulo']) . ' - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title mb-3"><?= htmlspecialchars($vaga['titulo']) ?></h1>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-money-bill-wave text-success"></i> Salário</h5>
                            <p class="text-muted"><?= $this->formatMoney($vaga['salario']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-map-marker-alt text-primary"></i> Localização</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['localizacao']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h5><i class="fas fa-briefcase text-info"></i> Experiência</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['exp']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5><i class="fas fa-graduation-cap text-warning"></i> Escolaridade</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['escolaridade']) ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5><i class="fas fa-user text-secondary"></i> Sexo</h5>
                            <p class="text-muted"><?= htmlspecialchars($vaga['sexo']) ?></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5><i class="fas fa-file-alt text-dark"></i> Descrição Completa</h5>
                        <div class="bg-light p-3 rounded">
                            <?= nl2br(htmlspecialchars($vaga['descricao_completa'])) ?>
                        </div>
                    </div>

                    <div class="text-muted small">
                        <i class="fas fa-calendar"></i> 
                        Publicada em: <?= date('d/m/Y', strtotime($vaga['data_postagem'])) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Ações</h5>
                    
                    <?php if ($this->isLoggedIn()): ?>
                        <?php if ($this->getSession('user_type') === 'candidato'): ?>
                            <form method="POST" action="/vagas/candidatar" class="mb-3">
                                <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Candidatar-se
                                </button>
                            </form>
                            
                            <!-- Botão de Denúncia -->
                            <button type="button" class="btn btn-outline-danger w-100 mb-3" data-bs-toggle="modal" data-bs-target="#denunciaModal">
                                <i class="fas fa-flag"></i> Denunciar Vaga
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Faça login para se candidatar a esta vaga.
                        </div>
                        <a href="/login" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Fazer Login
                        </a>
                    <?php endif; ?>

                    <hr>
                    
                    <a href="/vagas" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="fas fa-arrow-left"></i> Voltar às Vagas
                    </a>
                    
                    <a href="/" class="btn btn-outline-primary w-100">
                        <i class="fas fa-home"></i> Página Inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Denúncia -->
<div class="modal fade" id="denunciaModal" tabindex="-1" aria-labelledby="denunciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="denunciaModalLabel">
                    <i class="fas fa-flag text-danger"></i> Denunciar Vaga
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/vagas/denunciar">
                <div class="modal-body">
                    <input type="hidden" name="vaga_id" value="<?= $vaga['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo da Denúncia *</label>
                        <select class="form-select" id="motivo" name="motivo" required>
                            <option value="">Selecione um motivo</option>
                            <option value="conteudo_inadequado">Conteúdo Inadequado</option>
                            <option value="informacoes_falsas">Informações Falsas</option>
                            <option value="discriminacao">Discriminação</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição (Opcional)</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                                  placeholder="Descreva detalhes sobre a denúncia..."></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Importante:</strong> Sua denúncia será analisada pela nossa equipe. 
                        Denúncias falsas podem resultar em suspensão da conta.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-flag"></i> Enviar Denúncia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Mensagens de Status -->
<?php if (isset($_GET['status']) && $_GET['status'] === 'denuncia_sucesso'): ?>
    <div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;" role="alert">
        <i class="fas fa-check-circle"></i>
        <strong>Sucesso!</strong> Sua denúncia foi enviada e será analisada pela nossa equipe.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <?php
    $errorMessage = '';
    switch ($_GET['error']) {
        case 'ja_denunciada':
            $errorMessage = 'Você já denunciou esta vaga anteriormente.';
            break;
        case 'motivo_invalido':
            $errorMessage = 'Motivo de denúncia inválido.';
            break;
        case 'erro_denuncia':
            $errorMessage = 'Erro ao enviar denúncia. Tente novamente.';
            break;
    }
    ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;" role="alert">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>Erro!</strong> <?= $errorMessage ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?> 