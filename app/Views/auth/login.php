<?php
$title = 'Login - Ferraz Conecta';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Entrar</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Conta</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <option value="candidato">Candidato</option>
                                <option value="empresa">Empresa</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Entrar
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Não tem uma conta?</p>
                        <a href="/cadastro" class="btn btn-outline-primary me-2">Cadastrar Candidato</a>
                        <a href="/cadastro-empresa" class="btn btn-outline-secondary">Cadastrar Empresa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 