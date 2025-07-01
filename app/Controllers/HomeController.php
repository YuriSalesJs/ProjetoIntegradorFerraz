<?php

namespace App\Controllers;

use App\Models\Vaga;
use App\Models\Candidato;
use App\Models\Empresa;

class HomeController extends Controller
{
    private $vagaModel;
    private $candidatoModel;
    private $empresaModel;

    public function __construct()
    {
        $this->vagaModel = new Vaga();
        $this->candidatoModel = new Candidato();
        $this->empresaModel = new Empresa();
    }

    public function test()
    {
        try {
            $totalCandidatos = $this->candidatoModel->getEstatisticas();
            $totalEmpresas = $this->empresaModel->getEstatisticas();
            $totalVagas = $this->vagaModel->getEstatisticas();

            return $this->render('home/test', [
                'totalCandidatos' => $totalCandidatos,
                'totalEmpresas' => $totalEmpresas,
                'totalVagas' => $totalVagas['total_vagas'] ?? 0
            ]);
        } catch (\Exception $e) {
            return "<h1>Erro no Teste</h1><p>Erro: " . $e->getMessage() . "</p>";
        }
    }

    public function testFooter()
    {
        return $this->render('home/test_footer');
    }

    public function index()
    {
        try {
            $vagasDestaque = $this->vagaModel->getVagasDestaque(8);
            $totalCandidatos = $this->candidatoModel->getEstatisticas();
            $totalEmpresas = $this->empresaModel->getEstatisticas();
            $totalVagas = $this->vagaModel->getEstatisticas();

            return $this->render('home/index', [
                'vagasDestaque' => $vagasDestaque,
                'totalCandidatos' => $totalCandidatos,
                'totalEmpresas' => $totalEmpresas,
                'totalVagas' => $totalVagas['total_vagas'] ?? 0
            ]);
        } catch (\Exception $e) {
            return "<h1>Erro na Página Inicial</h1><p>Erro: " . $e->getMessage() . "</p>";
        }
    }

    public function sobre()
    {
        return $this->render('home/sobre');
    }

    public function empresas()
    {
        $empresas = $this->empresaModel->findAll();
        
        return $this->render('home/empresas', [
            'empresas' => $empresas
        ]);
    }

    public function detalhesEmpresa($id)
    {
        $empresa = $this->empresaModel->findById($id);
        
        if (!$empresa) {
            $this->redirect('/empresas');
        }

        $vagas = $this->vagaModel->getVagasPorEmpresa($id);
        
        return $this->render('home/detalhes_empresa', [
            'empresa' => $empresa,
            'vagas' => $vagas
        ]);
    }
} 