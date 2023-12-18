<?php

require_once __DIR__ . "/../Models/Session.php";

class SessionManagerRepository
{

    public function save(string $sessionId, array $sessionData, string $secretKey): ?Session
    {
        try {
            $encodedSessionId = urlencode($sessionId);

            $token = $this->generateToken($sessionData, $secretKey);
            $_SESSION['session_user_id']=  base64_encode($encodedSessionId);
            $_SESSION["token_" . $encodedSessionId] = $token;
            $session = new Session($encodedSessionId, $sessionData['Nomor_Identitas'], $sessionData['Level']);
            return $session;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function get(string $secretKey): ?Session
    {
        try {
            $sessionId = $_SESSION['session_user_id'] ?? null;
            $token = $_SESSION['token_' . base64_decode($sessionId)] ?? null;
            if (!$token) {
                return null;
            }
            $sessionData = $this->decodeToken($token, $secretKey);
            $session = new Session($sessionData['id'], $sessionData['Nomor_Identitas'], $sessionData['Level']);
            return $session;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destroy(): void
    {
        try {
            $sessionId = $_SESSION['session_user_id'] ?? null;
            unset($_SESSION['session_user_id']);
            unset($_SESSION['token_' . base64_decode($sessionId)]);
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
        $payload = json_decode(base64_decode($encodedPayload), true);
        $signature = base64_decode($encodedSignature);
        if ($signature !== base64_decode($encodedSignature)) {
            throw new Exception('Invalid token signature');
        }

        return $payload;
    }
}
