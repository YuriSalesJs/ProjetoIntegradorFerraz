<?php

namespace App\Controllers;

use App\Models\Vaga;
use App\Models\Candidato;

class VagaController extends Controller
{
    private $vagaModel;
    private $candidatoModel;

    public function __construct()
    {
        $this->vagaModel = new Vaga();
        $this->candidatoModel = new Candidato();
    }

    public function index()
    {
        $busca = $this->getQuery('busca');
        
        if ($busca) {
            $vagas = $this->vagaModel->buscarVagas($busca);
        } else {
            $vagas = $this->vagaModel->findAll();
        }

        return $this->render('vagas/index', [
            'vagas' => $vagas,
            'busca' => $busca
        ]);
    }

    public function show($id)
    {
        $vaga = $this->vagaModel->findById($id);
        
        if (!$vaga) {
            $this->redirect('/vagas');
        }

        return $this->render('vagas/show', [
            'vaga' => $vaga
        ]);
    }

    public function candidatar()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }

        if (!$this->isPost()) {
            $this->redirect('/vagas');
        }

        $vagaId = $this->getPost('vaga_id');
        $candidatoId = $this->getSession('user_id');

        if ($this->candidatoModel->candidatarVaga($candidatoId, $vagaId)) {
            $this->redirect('/?status=candidatura_sucesso');
        } else {
            $this->redirect('/vagas?error=ja_candidatado');
        }
    }

    public function desistir()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }

        if (!$this->isPost()) {
            $this->redirect('/minhas-candidaturas');
        }

        $vagaId = $this->getPost('vaga_id');
        $candidatoId = $this->getSession('user_id');

        $this->candidatoModel->desistirCandidatura($candidatoId, $vagaId);
        $this->redirect('/minhas-candidaturas?status=desistencia_sucesso');
    }

    public function create()
    {
        $this->requireAuth();
        
        // Verifica se é uma empresa
        if ($this->getSession('user_type') !== 'empresa') {
            $this->redirect('/login-empresa');
        }
        
        if ($this->isPost()) {
            $data = [
                'titulo' => $this->getPost('titulo'),
                'descricao_completa' => $this->getPost('descricao_completa'),
                'salario' => $this->getPost('salario'),
                'exp' => $this->getPost('exp'),
                'escolaridade' => $this->getPost('escolaridade'),
                'localizacao' => $this->getPost('localizacao'),
                'sexo' => $this->getPost('sexo'),
                'empresa_id' => $this->getSession('user_id'),
                'data_postagem' => date('Y-m-d H:i:s')
            ];

            $this->vagaModel->create($data);
            $this->redirect('/painel-empresa?status=vaga_criada');
        }

        return $this->render('vagas/create');
    }

    public function edit($id)
    {
        $this->requireAuth();
        
        $vaga = $this->vagaModel->findById($id);
        
        if (!$vaga || $vaga['empresa_id'] != $this->getSession('user_id')) {
            $this->redirect('/painel-empresa');
        }

        if ($this->isPost()) {
            $data = [
                'titulo' => $this->getPost('titulo'),
                'descricao_completa' => $this->getPost('descricao_completa'),
                'salario' => $this->getPost('salario'),
                'exp' => $this->getPost('exp'),
                'escolaridade' => $this->getPost('escolaridade'),
                'localizacao' => $this->getPost('localizacao'),
                'sexo' => $this->getPost('sexo')
            ];

            $this->vagaModel->update($id, $data);
            $this->redirect('/painel-empresa?status=vaga_atualizada');
        }

        return $this->render('vagas/edit', [
            'vaga' => $vaga
        ]);
    }

    public function delete($id)
    {
        $this->requireAuth();
        
        $vaga = $this->vagaModel->findById($id);
        
        if (!$vaga || $vaga['empresa_id'] != $this->getSession('user_id')) {
            $this->redirect('/painel-empresa');
        }

        $this->vagaModel->delete($id);
        $this->redirect('/painel-empresa?status=vaga_excluida');
    }
} 