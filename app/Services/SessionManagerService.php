<?php

class SessionManagerService
{
    private SessionManagerRepository $sessionManagerRepository;
    private string $secretKey;

    public function __construct(SessionManagerRepository $sessionManagerRepository)
    {
        $this->sessionManagerRepository = $sessionManagerRepository;
        $this->secretKey = env('APP_KEY');
    }

    public function create(string $userId, string $Nomor_Identitas, string $level): Session
    {
        try {
            $sessionId = $userId;
            $session = [
                'id' => $sessionId,
                'Nomor_Identitas' => $Nomor_Identitas,
                'level' => $level
            ];
            return $this->sessionManagerRepository->save($sessionId, $session, $this->secretKey);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function get(): ?Session
    {
        try {
            $session = $this->sessionManagerRepository->get($this->secretKey);
            return $session;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function destroy(string $userId): void
    {
        try {
            $this->sessionManagerRepository->destroy($userId);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
