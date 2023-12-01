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

    public function before() : void
    {
        try {
            $session = $this->sessionManagerService->get();
            http_response_code(401);
            if (!$session) {
                View::setFlashData('error', 'Unauthorized');
                View::redirect('/users/login');
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            View::renderView('error', ['message' => 'Internal Server Error']);
            exit();
        }
    }
}
