<?php

return [
    'name' => 'Ferraz Conecta',
    'version' => '1.0.0',
    'debug' => true,
    'url' => 'http://localhost/ProjetoIntegradorFerraz',
    
    // Configurações de sessão
    'session' => [
        'name' => 'ferraz_conecta_session',
        'lifetime' => 7200, // 2 horas
    ],
    
    // Configurações de upload
    'upload' => [
        'max_size' => 5 * 1024 * 1024, // 5MB
        'allowed_types' => ['pdf', 'doc', 'docx'],
        'upload_path' => __DIR__ . '/../public/uploads/',
    ],
    
    // Configurações de paginação
    'pagination' => [
        'per_page' => 10,
    ],
    
    // Configurações de segurança
    'security' => [
        'password_min_length' => 6,
        'csrf_token_name' => 'csrf_token',
    ],
]; 