<?php

namespace App\Models;

class Empresa extends Model
{
    protected $table = 'empresas';

    public function autenticar($email, $senha)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ? AND senha = ?";
        return $this->db->fetch($sql, [$email, $senha]);
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->db->fetch($sql, [$email]);
    }

    public function buscarEmpresas($busca)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE razao_social LIKE ? OR descricao LIKE ? 
                ORDER BY razao_social ASC";
        $buscaTerm = "%{$busca}%";
        return $this->db->fetchAll($sql, [$buscaTerm, $buscaTerm]);
    }

    public function getVagasEmpresa($empresaId)
    {
        $sql = "SELECT * FROM vagas WHERE empresa_id = ? ORDER BY data_postagem DESC";
        return $this->db->fetchAll($sql, [$empresaId]);
    }

    public function getCandidatosPorVaga($vagaId, $empresaId)
    {
        $sql = "SELECT c.*, cv.data_candidatura, cv.status 
                FROM candidatos_vagas cv 
                JOIN cadastro c ON cv.candidato_id = c.id 
                JOIN vagas v ON cv.vaga_id = v.id 
                WHERE cv.vaga_id = ? AND v.empresa_id = ? 
                ORDER BY cv.data_candidatura DESC";
        return $this->db->fetchAll($sql, [$vagaId, $empresaId]);
    }

    public function atualizarStatusCandidatura($candidatoId, $vagaId, $status)
    {
        $sql = "UPDATE candidatos_vagas SET status = ? WHERE candidato_id = ? AND vaga_id = ?";
        return $this->db->query($sql, [$status, $candidatoId, $vagaId]);
    }

    public function removerCandidato($candidatoId, $vagaId)
    {
        $sql = "DELETE FROM candidatos_vagas WHERE candidato_id = ? AND vaga_id = ?";
        return $this->db->query($sql, [$candidatoId, $vagaId]);
    }

    public function getEstatisticas()
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = $this->db->fetch($sql);
        return $result['total'];
    }
} 