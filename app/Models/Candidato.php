<?php

namespace App\Models;

class Candidato extends Model
{
    protected $table = 'cadastro';

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

    public function buscarPorProvider($provider, $providerId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE provider = ? AND provider_id = ?";
        return $this->db->fetch($sql, [$provider, $providerId]);
    }

    public function buscarPorEmailOuProvider($email, $provider = null, $providerId = null)
    {
        if ($provider && $providerId) {
            $sql = "SELECT * FROM {$this->table} WHERE email = ? OR (provider = ? AND provider_id = ?)";
            return $this->db->fetch($sql, [$email, $provider, $providerId]);
        } else {
            return $this->buscarPorEmail($email);
        }
    }

    public function getMinhasCandidaturas($candidatoId)
    {
        $sql = "SELECT v.*, v.id as vaga_id, e.razao_social, cv.data_candidatura, cv.status 
                FROM candidatos_vagas cv 
                JOIN vagas v ON cv.vaga_id = v.id 
                JOIN empresas e ON v.empresa_id = e.id 
                WHERE cv.candidato_id = ? 
                ORDER BY cv.data_candidatura DESC";
        return $this->db->fetchAll($sql, [$candidatoId]);
    }

    public function candidatarVaga($candidatoId, $vagaId)
    {
        // Verifica se já se candidatou
        $sql = "SELECT * FROM candidatos_vagas WHERE candidato_id = ? AND vaga_id = ?";
        $existente = $this->db->fetch($sql, [$candidatoId, $vagaId]);
        
        if ($existente) {
            return false; // Já se candidatou
        }

        $sql = "INSERT INTO candidatos_vagas (candidato_id, vaga_id, data_candidatura, status) VALUES (?, ?, NOW(), 'pendente')";
        return $this->db->query($sql, [$candidatoId, $vagaId]);
    }

    public function desistirCandidatura($candidatoId, $vagaId)
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