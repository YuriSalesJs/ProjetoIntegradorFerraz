<?php

namespace App\Controllers;

use App\Models\Candidato;

class CandidatoController extends Controller
{
    private $candidatoModel;

    public function __construct()
    {
        $this->candidatoModel = new Candidato();
    }

    public function minhasCandidaturas()
    {
        $this->requireAuth();
        
        $candidatoId = $this->getSession('user_id');
        $candidaturas = $this->candidatoModel->getMinhasCandidaturas($candidatoId);
        
        return $this->render('candidato/minhas_candidaturas', [
            'candidaturas' => $candidaturas
        ]);
    }

    public function perfil()
    {
        $this->requireAuth();
        
        $candidatoId = $this->getSession('user_id');
        $candidato = $this->candidatoModel->findById($candidatoId);
        
        return $this->render('candidato/perfil', [
            'candidato' => $candidato
        ]);
    }

    public function atualizarPerfil()
    {
        $this->requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect('/perfil');
        }
        
        $candidatoId = $this->getSession('user_id');
        $data = [
            'nome' => $this->getPost('nome'),
            'telefone' => $this->getPost('telefone'),
            'endereco' => $this->getPost('endereco')
        ];
        
        // Se uma nova senha foi fornecida
        if ($this->getPost('nova_senha')) {
            $data['senha'] = $this->getPost('nova_senha');
        }
        
        $this->candidatoModel->update($candidatoId, $data);
        $this->redirect('/perfil?status=perfil_atualizado');
    }
} 