<?php

namespace App\Models;

class SocialAuth
{
    private $config;
    private $candidatoModel;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../config/social_auth.php';
        $this->candidatoModel = new Candidato();
    }

    public function getGoogleAuthUrl()
    {
        $params = [
            'client_id' => $this->config['google']['client_id'],
            'redirect_uri' => $this->config['google']['redirect_uri'],
            'scope' => $this->config['google']['scope'],
            'response_type' => 'code'
        ];

        return $this->config['google']['auth_url'] . '?' . http_build_query($params);
    }

    public function getLinkedInAuthUrl()
    {
        $params = [
            'client_id' => $this->config['linkedin']['client_id'],
            'redirect_uri' => $this->config['linkedin']['redirect_uri'],
            'scope' => $this->config['linkedin']['scope'],
            'response_type' => 'code'
        ];

        return $this->config['linkedin']['auth_url'] . '?' . http_build_query($params);
    }

    public function handleGoogleCallback($code)
    {
        $tokenData = $this->getGoogleAccessToken($code);
        if (!$tokenData) return false;

        $userData = $this->getGoogleUserInfo($tokenData['access_token']);
        if (!$userData) return false;

        return $this->createOrLoginUser($userData, 'google');
    }

    public function handleLinkedInCallback($code)
    {
        $tokenData = $this->getLinkedInAccessToken($code);
        if (!$tokenData) return false;

        $userData = $this->getLinkedInUserInfo($tokenData['access_token']);
        if (!$userData) return false;

        return $this->createOrLoginUser($userData, 'linkedin');
    }

    private function getGoogleAccessToken($code)
    {
        $data = [
            'client_id' => $this->config['google']['client_id'],
            'client_secret' => $this->config['google']['client_secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->config['google']['redirect_uri']
        ];

        return $this->makeTokenRequest($this->config['google']['token_url'], $data);
    }

    private function getLinkedInAccessToken($code)
    {
        $data = [
            'client_id' => $this->config['linkedin']['client_id'],
            'client_secret' => $this->config['linkedin']['client_secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->config['linkedin']['redirect_uri']
        ];

        return $this->makeTokenRequest($this->config['linkedin']['token_url'], $data);
    }

    private function getGoogleUserInfo($accessToken)
    {
        $headers = ['Authorization: Bearer ' . $accessToken];
        $response = $this->makeApiRequest($this->config['google']['userinfo_url'], $headers);
        
        if ($response) {
            return [
                'id' => $response['id'],
                'email' => $response['email'],
                'nome' => $response['given_name'] . ' ' . $response['family_name'],
                'provider' => 'google',
                'provider_id' => $response['id']
            ];
        }
        return false;
    }

    private function getLinkedInUserInfo($accessToken)
    {
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'X-Restli-Protocol-Version: 2.0.0'
        ];

        $profileResponse = $this->makeApiRequest($this->config['linkedin']['userinfo_url'], $headers);
        if (!$profileResponse) return false;

        $emailResponse = $this->makeApiRequest($this->config['linkedin']['email_url'], $headers);
        $email = '';
        if ($emailResponse && isset($emailResponse['elements'][0]['handle~']['emailAddress'])) {
            $email = $emailResponse['elements'][0]['handle~']['emailAddress'];
        }

        return [
            'id' => $profileResponse['id'],
            'email' => $email,
            'nome' => $profileResponse['localizedFirstName'] . ' ' . $profileResponse['localizedLastName'],
            'provider' => 'linkedin',
            'provider_id' => $profileResponse['id']
        ];
    }

    private function createOrLoginUser($userData, $provider)
    {
        $existingUser = $this->candidatoModel->buscarPorEmail($userData['email']);
        
        if ($existingUser) {
            return ['action' => 'login', 'user' => $existingUser];
        } else {
            $newUserData = [
                'nome' => $userData['nome'],
                'email' => $userData['email'],
                'senha' => bin2hex(random_bytes(16)),
                'telefone' => '',
                'cpf' => '',
                'data_nascimento' => '',
                'endereco' => '',
                'provider' => $provider,
                'provider_id' => $userData['provider_id']
            ];

            $userId = $this->candidatoModel->create($newUserData);
            if ($userId) {
                $newUser = $this->candidatoModel->findById($userId);
                return ['action' => 'register', 'user' => $newUser];
            }
        }
        return false;
    }

    private function makeTokenRequest($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($httpCode === 200) ? json_decode($response, true) : false;
    }

    private function makeApiRequest($url, $headers = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($httpCode === 200) ? json_decode($response, true) : false;
    }
} 