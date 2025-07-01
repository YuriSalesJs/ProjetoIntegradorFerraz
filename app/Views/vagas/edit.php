<?php
$title = 'Editar Vaga - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title mb-4">
                        <i class="fas fa-edit text-primary"></i> Editar Vaga
                    </h2>

                    <form method="POST" action="/vagas/editar/<?= $vaga['id'] ?>">
                        <div class="mb-3">
                            <label for="titulo" class="form-label required">Título da Vaga</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" 
                                value="<?= htmlspecialchars($vaga['titulo']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_completa" class="form-label required">Descrição Completa</label>
                            <textarea class="form-control" id="descricao_completa" name="descricao_completa" rows="6" required><?= htmlspecialchars($vaga['descricao_completa']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salario" class="form-label required">Salário (R$)</label>
                                <input type="text" class="form-control" id="salario" name="salario" 
                                    value="<?= htmlspecialchars($vaga['salario']) ?>" required>
                                <input type="hidden" name="salario_numerico" id="salario_numerico" value="<?= htmlspecialchars($vaga['salario']) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="localizacao" class="form-label required">Localização</label>
                                <input type="text" class="form-control" id="localizacao" name="localizacao" 
                                    value="<?= htmlspecialchars($vaga['localizacao']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="exp" class="form-label">Experiência</label>
                                <select class="form-select" id="exp" name="exp" required>
                                    <option value="">Selecione...</option>
                                    <option value="Sem experiência" <?= $vaga['exp'] === 'Sem experiência' ? 'selected' : '' ?>>Sem experiência</option>
                                    <option value="1-2 anos" <?= $vaga['exp'] === '1-2 anos' ? 'selected' : '' ?>>1-2 anos</option>
                                    <option value="3-5 anos" <?= $vaga['exp'] === '3-5 anos' ? 'selected' : '' ?>>3-5 anos</option>
                                    <option value="5+ anos" <?= $vaga['exp'] === '5+ anos' ? 'selected' : '' ?>>5+ anos</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="escolaridade" class="form-label">Escolaridade</label>
                                <select class="form-select" id="escolaridade" name="escolaridade" required>
                                    <option value="">Selecione...</option>
                                    <option value="Ensino Fundamental" <?= $vaga['escolaridade'] === 'Ensino Fundamental' ? 'selected' : '' ?>>Ensino Fundamental</option>
                                    <option value="Ensino Médio" <?= $vaga['escolaridade'] === 'Ensino Médio' ? 'selected' : '' ?>>Ensino Médio</option>
                                    <option value="Técnico" <?= $vaga['escolaridade'] === 'Técnico' ? 'selected' : '' ?>>Técnico</option>
                                    <option value="Superior Incompleto" <?= $vaga['escolaridade'] === 'Superior Incompleto' ? 'selected' : '' ?>>Superior Incompleto</option>
                                    <option value="Superior Completo" <?= $vaga['escolaridade'] === 'Superior Completo' ? 'selected' : '' ?>>Superior Completo</option>
                                    <option value="Pós-graduação" <?= $vaga['escolaridade'] === 'Pós-graduação' ? 'selected' : '' ?>>Pós-graduação</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="sexo" name="sexo" required>
                                    <option value="">Selecione...</option>
                                    <option value="Indiferente" <?= $vaga['sexo'] === 'Indiferente' ? 'selected' : '' ?>>Indiferente</option>
                                    <option value="Masculino" <?= $vaga['sexo'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="Feminino" <?= $vaga['sexo'] === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Atualizar Vaga
                            </button>
                            <a href="/painel-empresa" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 