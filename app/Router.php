<?php

namespace App;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function dispatch($method, $uri)
    {
        try {
            // Remove query string da URI
            $uri = parse_url($uri, PHP_URL_PATH);
            
            // Remove o caminho base do projeto se existir
            $basePath = '/ProjetoIntegradorFerraz/public';
            if (strpos($uri, $basePath) === 0) {
                $uri = substr($uri, strlen($basePath));
            }
            
            // Se a URI estiver vazia, define como '/'
            if (empty($uri)) {
                $uri = '/';
            }
            
            foreach ($this->routes as $route) {
                if ($route['method'] === $method && $this->matchPath($route['path'], $uri)) {
                    $result = $this->executeHandler($route['handler'], $this->extractParams($route['path'], $uri));
                    
                    // Se o resultado não for nulo, exibe
                    if ($result !== null) {
                        echo $result;
                    }
                    return;
                }
            }
            
            // Rota não encontrada
            http_response_code(404);
            echo "<h1>Página não encontrada</h1>";
            echo "<p>A rota '{$uri}' não foi encontrada.</p>";
            echo "<p><a href='/'>Voltar para página inicial</a></p>";
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo "<h1>Erro Interno</h1>";
            echo "<p>Erro: " . $e->getMessage() . "</p>";
            echo "<p>Arquivo: " . $e->getFile() . "</p>";
            echo "<p>Linha: " . $e->getLine() . "</p>";
        }
    }

    private function matchPath($routePath, $uri)
    {
        $routePattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $routePath);
        $routePattern = '#^' . $routePattern . '$#';
        
        return preg_match($routePattern, $uri);
    }

    private function extractParams($routePath, $uri)
    {
        $params = [];
        $routeParts = explode('/', trim($routePath, '/'));
        $uriParts = explode('/', trim($uri, '/'));
        
        foreach ($routeParts as $index => $part) {
            if (preg_match('/\{([^}]+)\}/', $part, $matches)) {
                $paramName = $matches[1];
                $params[$paramName] = $uriParts[$index] ?? null;
            }
        }
        
        return $params;
    }

    private function executeHandler($handler, $params)
    {
        try {
            if (is_callable($handler)) {
                return call_user_func_array($handler, array_values($params));
            }
            
            if (is_string($handler)) {
                $parts = explode('@', $handler);
                $controllerClass = "App\\Controllers\\{$parts[0]}";
                $method = $parts[1];
                
                if (!class_exists($controllerClass)) {
                    throw new \Exception("Classe {$controllerClass} não encontrada");
                }
                
                $controller = new $controllerClass();
                
                if (!method_exists($controller, $method)) {
                    throw new \Exception("Método {$method} não encontrado na classe {$controllerClass}");
                }
                
                return call_user_func_array([$controller, $method], array_values($params));
            }
            
            throw new \Exception("Handler inválido");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao executar handler: " . $e->getMessage());
        }
    }
} 