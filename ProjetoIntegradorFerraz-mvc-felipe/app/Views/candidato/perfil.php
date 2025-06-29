<?php
$title = 'Meu Perfil - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title mb-4">
                        <i class="fas fa-user text-primary"></i> Meu Perfil
                    </h2>

                    <?php if (isset($_GET['status']) && $_GET['status'] === 'perfil_atualizado'): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> Perfil atualizado com sucesso!
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/perfil/atualizar">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label required">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                    value="<?= htmlspecialchars($candidato['nome']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" 
                                    value="<?= htmlspecialchars($candidato['email']) ?>" readonly>
                                <small class="text-muted">O email não pode ser alterado</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label required">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" 
                                    value="<?= htmlspecialchars($candidato['telefone']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" 
                                    value="<?= htmlspecialchars($candidato['cpf']) ?>" readonly>
                                <small class="text-muted">O CPF não pode ser alterado</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" 
                                value="<?= htmlspecialchars($candidato['data_nascimento']) ?>" readonly>
                            <small class="text-muted">A data de nascimento não pode ser alterada</small>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label required">Endereço</label>
                            <textarea class="form-control" id="endereco" name="endereco" rows="3" required><?= htmlspecialchars($candidato['endereco']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nova_senha" class="form-label">Nova Senha (opcional)</label>
                            <input type="password" class="form-control" id="nova_senha" name="nova_senha" 
                                placeholder="Deixe em branco para manter a senha atual">
                            <small class="text-muted">Preencha apenas se desejar alterar sua senha</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Atualizar Perfil
                            </button>
                            <a href="/" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Ações Rápidas</h5>
                    <div class="d-grid gap-2">
                        <a href="/minhas-candidaturas" class="btn btn-outline-primary">
                            <i class="fas fa-briefcase"></i> Minhas Candidaturas
                        </a>
                        <a href="/vagas" class="btn btn-outline-success">
                            <i class="fas fa-search"></i> Procurar Vagas
                        </a>
                        <a href="/logout" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Informações da Conta</h5>
                    <ul class="list-unstyled">
                        <li><strong>Membro desde:</strong> <?= date('d/m/Y', strtotime($candidato['data_cadastro'])) ?></li>
                        <li><strong>Status:</strong> <span class="badge bg-success">Ativo</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> 