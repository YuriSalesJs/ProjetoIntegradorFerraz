<?php

namespace App\Controllers;

use App\Models\Candidato;
use App\Models\Empresa;
use App\Models\SocialAuth;

class AuthController extends Controller
{
    private $candidatoModel;
    private $empresaModel;
    private $socialAuth;

    public function __construct()
    {
        $this->candidatoModel = new Candidato();
        $this->empresaModel = new Empresa();
        $this->socialAuth = new SocialAuth();
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }

        if ($this->isPost()) {
            $email = $this->getPost('email');
            $senha = $this->getPost('senha');
            $tipo = $this->getPost('tipo', 'candidato');

            if ($tipo === 'empresa') {
                $user = $this->empresaModel->autenticar($email, $senha);
            } else {
                $user = $this->candidatoModel->autenticar($email, $senha);
            }

            if ($user) {
                $this->setSession('user_id', $user['id']);
                $this->setSession('user_type', $tipo);
                $this->setSession('user_name', $user['nome'] ?? $user['razao_social']);
                
                if ($tipo === 'empresa') {
                    $this->redirect('/painel-empresa');
                } else {
                    $this->redirect('/');
                }
            } else {
                return $this->render('auth/login', [
                    'error' => 'Email ou senha incorretos'
                ]);
            }
        }

        return $this->render('auth/login');
    }

    public function loginEmpresa()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/painel-empresa');
        }

        if ($this->isPost()) {
            $email = $this->getPost('email');
            $senha = $this->getPost('senha');

            $user = $this->empresaModel->autenticar($email, $senha);

            if ($user) {
                $this->setSession('user_id', $user['id']);
                $this->setSession('user_type', 'empresa');
                $this->setSession('user_name', $user['razao_social']);
                $this->redirect('/painel-empresa');
            } else {
                return $this->render('auth/login_empresa', [
                    'error' => 'Email ou senha incorretos'
                ]);
            }
        }

        return $this->render('auth/login_empresa');
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }

        if ($this->isPost()) {
            $data = [
                'nome' => $this->getPost('nome'),
                'email' => $this->getPost('email'),
                'senha' => $this->getPost('senha'),
                'telefone' => $this->getPost('telefone'),
                'cpf' => $this->getPost('cpf'),
                'data_nascimento' => $this->getPost('data_nascimento'),
                'endereco' => $this->getPost('endereco')
            ];

            // Verifica se o email já existe
            if ($this->candidatoModel->buscarPorEmail($data['email'])) {
                return $this->render('auth/register', [
                    'error' => 'Este email já está cadastrado'
                ]);
            }

            $userId = $this->candidatoModel->create($data);
            
            if ($userId) {
                $this->setSession('user_id', $userId);
                $this->setSession('user_type', 'candidato');
                $this->setSession('user_name', $data['nome']);
                $this->redirect('/?status=cadastro_sucesso');
            } else {
                return $this->render('auth/register', [
                    'error' => 'Erro ao criar conta'
                ]);
            }
        }

        return $this->render('auth/register');
    }

    public function registerEmpresa()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/painel-empresa');
        }

        if ($this->isPost()) {
            $data = [
                'razao_social' => $this->getPost('razao_social'),
                'email' => $this->getPost('email'),
                'senha' => $this->getPost('senha'),
                'telefone' => $this->getPost('telefone'),
                'cnpj' => $this->getPost('cnpj'),
                'endereco' => $this->getPost('endereco'),
                'descricao' => $this->getPost('descricao')
            ];

            // Verifica se o email já existe
            if ($this->empresaModel->buscarPorEmail($data['email'])) {
                return $this->render('auth/register_empresa', [
                    'error' => 'Este email já está cadastrado'
                ]);
            }

            $userId = $this->empresaModel->create($data);
            
            if ($userId) {
                $this->setSession('user_id', $userId);
                $this->setSession('user_type', 'empresa');
                $this->setSession('user_name', $data['razao_social']);
                $this->redirect('/painel-empresa?status=cadastro_sucesso');
            } else {
                return $this->render('auth/register_empresa', [
                    'error' => 'Erro ao criar conta'
                ]);
            }
        }

        return $this->render('auth/register_empresa');
    }

    public function logout()
    {
        $this->destroySession();
        $this->redirect('/');
    }

    public function googleAuth()
    {
        $authUrl = $this->socialAuth->getGoogleAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    }

    public function linkedinAuth()
    {
        $authUrl = $this->socialAuth->getLinkedInAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    }

    public function googleCallback()
    {
        $code = $_GET['code'] ?? null;
        
        if (!$code) {
            $this->redirect('/login?error=google_auth_failed');
        }

        $result = $this->socialAuth->handleGoogleCallback($code);
        
        if ($result) {
            $this->setSession('user_id', $result['user']['id']);
            $this->setSession('user_type', 'candidato');
            $this->setSession('user_name', $result['user']['nome']);
            
            if ($result['action'] === 'register') {
                $this->redirect('/?status=social_register_success');
            } else {
                $this->redirect('/?status=social_login_success');
            }
        } else {
            $this->redirect('/login?error=google_auth_failed');
        }
    }

    public function linkedinCallback()
    {
        $code = $_GET['code'] ?? null;
        
        if (!$code) {
            $this->redirect('/login?error=linkedin_auth_failed');
        }

        $result = $this->socialAuth->handleLinkedInCallback($code);
        
        if ($result) {
            $this->setSession('user_id', $result['user']['id']);
            $this->setSession('user_type', 'candidato');
            $this->setSession('user_name', $result['user']['nome']);
            
            if ($result['action'] === 'register') {
                $this->redirect('/?status=social_register_success');
            } else {
                $this->redirect('/?status=social_login_success');
            }
        } else {
            $this->redirect('/login?error=linkedin_auth_failed');
        }
    }
} 