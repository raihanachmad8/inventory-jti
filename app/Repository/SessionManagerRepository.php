<?php

require_once __DIR__ . "/../Models/Session.php";

class SessionManagerRepository
{

    public function save(string $sessionId, array $sessionData, string $secretKey): ?Session
    {
        try {
            $encodedSessionId = urlencode($sessionId);

            $token = $this->generateToken($sessionData, $secretKey);
            setcookie('session_user_id', base64_encode($encodedSessionId), time() + 3600, '/');
            setcookie('token_' . $encodedSessionId, $token, time() + 3600, '/');
            $session = new Session($encodedSessionId, $sessionData['nomor_identitas'], $sessionData['level']);
            return $session;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function get(string $secretKey): ?Session
    {
        try {
            $sessionId = $_COOKIE['session_user_id'] ?? null;
            $token = $_COOKIE['token_' . base64_decode($sessionId)] ?? null;
            if (!$token) {
                return null;
            }
            $sessionData = $this->decodeToken($token, $secretKey);
            $session = new Session($sessionData['id'], $sessionData['nomor_identitas'], $sessionData['level']);
            return $session;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }




    public function delete(): void
    {
        try {
            $sessionId = $_COOKIE['session_user_id'] ?? null;
            setcookie('session_user_id', '', time() - 3600, '/');
            setcookie('token_' . base64_decode($sessionId), '', time() - 3600, '/');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function generateToken(array $sessionData, string $secretKey): string
    {
        $payload = json_encode($sessionData);


        $signature = hash_hmac('sha256', $payload . base64_encode(random_bytes(32)), $secretKey, true);
        return base64_encode($payload) . '.' . base64_encode($signature);
    }

    private function decodeToken(string $token, string $secretKey): array
    {
        list($encodedPayload, $encodedSignature) = explode('.', $token, 2);
        die($encodedPayload);
        $payload = json_decode(base64_decode($encodedPayload), true);
        $signature = base64_decode($encodedSignature);
        if ($signature !== base64_decode($encodedSignature)) {
            throw new Exception('Invalid token signature');
        }

        return $payload;
    }
}
