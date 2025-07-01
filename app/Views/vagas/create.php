<?php
$title = 'Criar Nova Vaga - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title mb-4">
                        <i class="fas fa-plus-circle text-primary"></i> Criar Nova Vaga
                    </h2>

                    <form method="POST" action="/vagas/criar">
                        <div class="mb-3">
                            <label for="titulo" class="form-label required">Título da Vaga</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_completa" class="form-label required">Descrição Completa</label>
                            <textarea class="form-control" id="descricao_completa" name="descricao_completa" rows="6" required 
                                placeholder="Descreva detalhadamente a vaga, responsabilidades, requisitos, benefícios..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salario" class="form-label required">Salário (R$)</label>
                                <input type="text" class="form-control" id="salario" name="salario" required>
                                <input type="hidden" name="salario_numerico" id="salario_numerico">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="localizacao" class="form-label required">Localização</label>
                                <input type="text" class="form-control" id="localizacao" name="localizacao" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="exp" class="form-label">Experiência</label>
                                <select class="form-select" id="exp" name="exp" required>
                                    <option value="">Selecione...</option>
                                    <option value="Sem experiência">Sem experiência</option>
                                    <option value="1-2 anos">1-2 anos</option>
                                    <option value="3-5 anos">3-5 anos</option>
                                    <option value="5+ anos">5+ anos</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="escolaridade" class="form-label">Escolaridade</label>
                                <select class="form-select" id="escolaridade" name="escolaridade" required>
                                    <option value="">Selecione...</option>
                                    <option value="Ensino Fundamental">Ensino Fundamental</option>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Superior Incompleto">Superior Incompleto</option>
                                    <option value="Superior Completo">Superior Completo</option>
                                    <option value="Pós-graduação">Pós-graduação</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="sexo" name="sexo" required>
                                    <option value="">Selecione...</option>
                                    <option value="Indiferente">Indiferente</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Criar Vaga
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