<?php

require_once __DIR__ . '/Middleware.php';

require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';

class AuthOnlyMiddleware implements Middleware
{
    private SessionManagerService $sessionManagerService;

    public function __construct()
    {
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
    }

    public function before(): void
    {
        try {
            $session = $this->sessionManagerService->get();

            if (!$session) {
                $this->handleUnauthorizedAccess();
            }
        } catch (Exception $e) {
            $this->handleInternalServerError();
        }
    }

    private function handleUnauthorizedAccess(): void
    {
        header('HTTP/1.1 401 Unauthorized');
        View::setFlashData('error', 'Unauthorized access. Please log in.');
        View::redirect('/users/login');
        exit();
    }

    private function handleInternalServerError(): void
    {
        header('HTTP/1.1 500 Internal Server Error');
        View::renderView('error', ['message' => 'Internal Server Error']);
        exit();
    }
}
