<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

// Inicia a sessão
session_start();

// Cria o roteador
$router = new Router();

// Rota de teste
$router->get('/test', 'HomeController@test');
$router->get('/test-footer', 'HomeController@testFooter');

// Rotas da aplicação
$router->get('/', 'HomeController@index');
$router->get('/sobre', 'HomeController@sobre');

// Rotas de empresas (públicas)
$router->get('/empresas', 'EmpresaController@index');
$router->get('/empresas/{id}', 'EmpresaController@show');

// Rotas de autenticação
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');
$router->get('/login-empresa', 'AuthController@loginEmpresa');
$router->post('/login-empresa', 'AuthController@loginEmpresa');
$router->get('/cadastro', 'AuthController@register');
$router->post('/cadastro', 'AuthController@register');
$router->get('/cadastro-empresa', 'AuthController@registerEmpresa');
$router->post('/cadastro-empresa', 'AuthController@registerEmpresa');
$router->get('/logout', 'AuthController@logout');

// Rotas de autenticação social
$router->get('/auth/google', 'AuthController@googleAuth');
$router->get('/auth/google/callback', 'AuthController@googleCallback');
$router->get('/auth/linkedin', 'AuthController@linkedinAuth');
$router->get('/auth/linkedin/callback', 'AuthController@linkedinCallback');

// Rotas de vagas
$router->get('/vagas', 'VagaController@index');
$router->get('/vagas/criar', 'VagaController@create');
$router->post('/vagas/criar', 'VagaController@create');
$router->post('/vagas/candidatar', 'VagaController@candidatar');
$router->post('/vagas/desistir', 'VagaController@desistir');
$router->post('/vagas/denunciar', 'VagaController@denunciar');
$router->get('/vagas/{id}', 'VagaController@show');
$router->get('/vagas/{id}/editar', 'VagaController@edit');
$router->post('/vagas/{id}/editar', 'VagaController@edit');
$router->post('/vagas/{id}/excluir', 'VagaController@delete');

// Rotas de candidatos
$router->get('/minhas-candidaturas', 'CandidatoController@minhasCandidaturas');
$router->get('/perfil', 'CandidatoController@perfil');
$router->post('/perfil/atualizar', 'CandidatoController@atualizarPerfil');

// Rotas de empresas (privadas)
$router->get('/painel-empresa', 'EmpresaController@painel');
$router->get('/empresa/vagas', 'EmpresaController@minhasVagas');
$router->get('/empresa/vagas/{id}/candidatos', 'EmpresaController@candidatosVaga');
$router->post('/empresa/candidatos/status', 'EmpresaController@atualizarStatusCandidato');
$router->post('/empresa/candidatos/remover', 'EmpresaController@removerCandidato');

// Despacha a requisição
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri); 