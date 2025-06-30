<?php

namespace App\Models;

use mysqli;
use mysqli_stmt;

class DatabaseMysqli
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        
        $this->connection = mysqli_connect(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );
        
        if (!$this->connection) {
            throw new \Exception("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }
        
        mysqli_set_charset($this->connection, $config['charset']);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($sql, $params = [])
    {
        if (!empty($params)) {
            $stmt = mysqli_prepare($this->connection, $sql);
            if ($stmt === false) {
                throw new \Exception("Erro na preparação da query: " . mysqli_error($this->connection));
            }
            
            $types = str_repeat('s', count($params));
            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
            
            return $stmt;
        } else {
            $result = mysqli_query($this->connection, $sql);
            if ($result === false) {
                throw new \Exception("Erro na execução da query: " . mysqli_error($this->connection));
            }
            return $result;
        }
    }

    public function fetchAll($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        
        if ($result instanceof mysqli_stmt) {
            $result = mysqli_stmt_get_result($result);
        }
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        return $data;
    }

    public function fetch($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        
        if ($result instanceof mysqli_stmt) {
            $result = mysqli_stmt_get_result($result);
        }
        
        return mysqli_fetch_assoc($result);
    }

    public function lastInsertId()
    {
        return mysqli_insert_id($this->connection);
    }
} 