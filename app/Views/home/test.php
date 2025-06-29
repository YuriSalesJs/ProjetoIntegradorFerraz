<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste - Ferraz Conecta</title>
</head>
<body>
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
    <p><a href="/">Voltar para página inicial</a></p>
</body>
</html> 