<?php

require_once __DIR__ . '/Middleware.php';

class AdminOnlyMiddleware implements Middleware
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

            if (!$session || $session->Level !== 'Admin') {
                $this->handleUnauthorizedAccess();
            }
        } catch (Exception $e) {
            $this->handleInternalServerError();
        }
    }

    private function handleUnauthorizedAccess(): void
    {
        header('HTTP/1.1 404 Not Found');
        View::renderView('404', ['message' => 'Page not found']);
        exit();
    }

    private function handleInternalServerError(): void
    {
        header('HTTP/1.1 500 Internal Server Error');
        View::renderView('error', ['message' => 'Internal Server Error']);
        exit();
    }
}
