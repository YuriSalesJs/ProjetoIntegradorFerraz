<?php
$title = 'Teste - Ferraz Conecta';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Teste de View</h1>
            <p>Esta é uma view de teste para verificar se o sistema de renderização está funcionando.</p>
            
            <?php if (isset($totalCandidatos)): ?>
                <p>Total de candidatos: <?= $totalCandidatos ?></p>
            <?php endif; ?>
            
            <?php if (isset($totalEmpresas)): ?>
                <p>Total de empresas: <?= $totalEmpresas ?></p>
            <?php endif; ?>
            
            <?php if (isset($totalVagas)): ?>
                <p>Total de vagas: <?= $totalVagas ?></p>
            <?php endif; ?>
            
            <hr>
            <p><a href="/" class="btn btn-primary">Voltar para página inicial</a></p>
        </div>
    </div>
</div> 