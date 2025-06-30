<?php

namespace App\Models;

class Vaga extends Model
{
    protected $table = 'vagas';

    public function getVagasDestaque($limit = 8)
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }

    public function buscarVagas($termo)
    {
        $sql = "SELECT v.*, e.razao_social as empresa_nome 
                FROM {$this->table} v 
                JOIN empresas e ON v.empresa_id = e.id 
                WHERE v.titulo LIKE ? OR v.descricao_completa LIKE ? 
                ORDER BY v.data_postagem DESC";
        $termo = "%{$termo}%";
        return $this->db->fetchAll($sql, [$termo, $termo]);
    }

    public function getVagasPorEmpresa($empresaId)
    {
        $sql = "SELECT v.*, e.razao_social as empresa_nome 
                FROM {$this->table} v 
                JOIN empresas e ON v.empresa_id = e.id 
                WHERE v.empresa_id = ? 
                ORDER BY v.data_postagem DESC";
        return $this->db->fetchAll($sql, [$empresaId]);
    }

    public function getCandidatosVaga($vagaId)
    {
        $sql = "SELECT c.*, cv.data_candidatura, cv.status 
                FROM candidatos_vagas cv 
                JOIN cadastro c ON cv.candidato_id = c.id 
                WHERE cv.vaga_id = ? 
                ORDER BY cv.data_candidatura DESC";
        return $this->db->fetchAll($sql, [$vagaId]);
    }

    public function getEstatisticas()
    {
        $sql = "SELECT 
                    COUNT(*) as total_vagas,
                    COUNT(CASE WHEN status = 'ativa' THEN 1 END) as vagas_ativas,
                    COUNT(CASE WHEN status = 'fechada' THEN 1 END) as vagas_fechadas
                FROM {$this->table}";
        return $this->db->fetch($sql);
    }

    public function findAll()
    {
        $sql = "SELECT v.*, e.razao_social as empresa_nome 
                FROM {$this->table} v 
                JOIN empresas e ON v.empresa_id = e.id 
                ORDER BY v.data_postagem DESC";
        return $this->db->fetchAll($sql);
    }

    // Métodos para denúncias
    public function denunciarVaga($candidatoId, $vagaId, $motivo, $descricao = null)
    {
        $sql = "INSERT INTO denuncias_vagas (candidato_id, vaga_id, motivo, descricao) 
                VALUES (?, ?, ?, ?)";
        return $this->db->execute($sql, [$candidatoId, $vagaId, $motivo, $descricao]);
    }

    public function verificarDenunciaExistente($candidatoId, $vagaId)
    {
        $sql = "SELECT id FROM denuncias_vagas WHERE candidato_id = ? AND vaga_id = ?";
        return $this->db->fetch($sql, [$candidatoId, $vagaId]);
    }

    public function getDenunciasVaga($vagaId)
    {
        $sql = "SELECT dv.*, c.nome as candidato_nome 
                FROM denuncias_vagas dv 
                JOIN cadastro c ON dv.candidato_id = c.id 
                WHERE dv.vaga_id = ? 
                ORDER BY dv.data_denuncia DESC";
        return $this->db->fetchAll($sql, [$vagaId]);
    }

    public function getTodasDenuncias()
    {
        $sql = "SELECT dv.*, c.nome as candidato_nome, v.titulo as vaga_titulo, e.razao_social as empresa_nome
                FROM denuncias_vagas dv 
                JOIN cadastro c ON dv.candidato_id = c.id 
                JOIN vagas v ON dv.vaga_id = v.id 
                JOIN empresas e ON v.empresa_id = e.id 
                ORDER BY dv.data_denuncia DESC";
        return $this->db->fetchAll($sql);
    }
} 