<?php

namespace App\Controllers;

use App\Models\Empresa;
use App\Models\Vaga;

class EmpresaController extends Controller
{
    private $empresaModel;
    private $vagaModel;

    public function __construct()
    {
        $this->empresaModel = new Empresa();
        $this->vagaModel = new Vaga();
    }

    public function index()
    {
        $busca = $this->getQuery('busca');
        
        if ($busca) {
            $empresas = $this->empresaModel->buscarEmpresas($busca);
        } else {
            $empresas = $this->empresaModel->findAll();
        }

        return $this->render('empresa/index', [
            'empresas' => $empresas,
            'busca' => $busca
        ]);
    }

    public function show($id)
    {
        $empresa = $this->empresaModel->findById($id);
        
        if (!$empresa) {
            $this->redirect('/empresas');
        }

        $vagas = $this->empresaModel->getVagasEmpresa($id);
        
        return $this->render('empresa/show', [
            'empresa' => $empresa,
            'vagas' => $vagas
        ]);
    }

    public function painel()
    {
        $this->requireAuth();
        
        $empresaId = $this->getSession('user_id');
        $empresa = $this->empresaModel->findById($empresaId);
        $vagas = $this->empresaModel->getVagasEmpresa($empresaId);
        
        return $this->render('empresa/painel', [
            'empresa' => $empresa,
            'vagas' => $vagas
        ]);
    }

    public function minhasVagas()
    {
        $this->requireAuth();
        
        $empresaId = $this->getSession('user_id');
        $vagas = $this->empresaModel->getVagasEmpresa($empresaId);
        
        return $this->render('empresa/minhas_vagas', [
            'vagas' => $vagas
        ]);
    }

    public function candidatosVaga($vagaId)
    {
        $this->requireAuth();
        
        $empresaId = $this->getSession('user_id');
        $vaga = $this->vagaModel->findById($vagaId);
        
        // Verifica se a vaga pertence à empresa
        if (!$vaga || $vaga['empresa_id'] != $empresaId) {
            $this->redirect('/painel-empresa');
        }
        
        $candidatos = $this->empresaModel->getCandidatosPorVaga($vagaId, $empresaId);
        
        return $this->render('empresa/candidatos_vaga', [
            'vaga' => $vaga,
            'candidatos' => $candidatos
        ]);
    }

    public function atualizarStatusCandidato()
    {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('/painel-empresa');
        }
        
        $candidatoId = $this->getPost('candidato_id');
        $vagaId = $this->getPost('vaga_id');
        $status = $this->getPost('status');
        
        $this->empresaModel->atualizarStatusCandidatura($candidatoId, $vagaId, $status);
        $this->redirect("/empresa/vagas/{$vagaId}/candidatos?status=status_atualizado");
    }

    public function removerCandidato()
    {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('/painel-empresa');
        }
        
        $candidatoId = $this->getPost('candidato_id');
        $vagaId = $this->getPost('vaga_id');
        
        $this->empresaModel->removerCandidato($candidatoId, $vagaId);
        $this->redirect("/empresa/vagas/{$vagaId}/candidatos?status=candidato_removido");
    }
} 