<?php

namespace App\Controllers;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        try {
            // Extrai os dados para variáveis que podem ser usadas na view
            extract($data);
            
            // Inicia o buffer de saída
            ob_start();
            
            // Inclui a view
            $viewPath = __DIR__ . "/../Views/{$view}.php";
            
            if (file_exists($viewPath)) {
                include $viewPath;
            } else {
                throw new \Exception("View não encontrada: {$viewPath}");
            }
            
            // Captura o conteúdo da view
            $content = ob_get_clean();
            
            if ($content === false) {
                throw new \Exception("Erro ao capturar conteúdo da view");
            }
            
            // Se não for uma view completa (sem HTML), usa o layout
            if (!str_contains($content, '<!DOCTYPE html>')) {
                return $this->renderWithLayout($content, $data);
            }
            
            return $content;
        } catch (\Exception $e) {
            // Em caso de erro, retorna uma mensagem de erro
            return "<h1>Erro na View</h1><p>Erro: " . $e->getMessage() . "</p><p>View: {$view}</p>";
        }
    }

    protected function renderWithLayout($content, $data = [])
    {
        // Extrai os dados para variáveis
        extract($data);
        
        // Inicia o buffer de saída
        ob_start();
        
        // Inclui o layout
        $layoutPath = __DIR__ . "/../Views/layouts/base.php";
        
        if (file_exists($layoutPath)) {
            include $layoutPath;
        } else {
            throw new \Exception("Layout não encontrado: {$layoutPath}");
        }
        
        // Retorna o conteúdo do buffer
        return ob_get_clean();
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function getPost($key = null, $default = null)
    {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }

    protected function getQuery($key = null, $default = null)
    {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }

    protected function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    protected function getSession($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    protected function destroySession()
    {
        session_destroy();
    }

    protected function isLoggedIn()
    {
        return $this->getSession('user_id') !== null;
    }

    protected function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function formatMoney($value)
    {
        if (empty($value) || $value == 0) {
            return 'A combinar';
        }
        
        // Converte para float se for string
        $value = floatval($value);
        
        // Formata no padrão brasileiro
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
} 