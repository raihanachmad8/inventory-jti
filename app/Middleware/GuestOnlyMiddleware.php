<?php

require_once __DIR__ . '/Middleware.php';

require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';

class GuestOnlyMiddleware implements Middleware
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
            if ($session !== null) {
                if ($session->Level === 'Admin') {
                    View::redirect('/admin/dashboard');
                    exit();
                } else if (in_array($session->Level, ['Dosen', 'Mahasiswa'])) {
                    View::redirect('/inventory/dashboard');
                    exit();
                }
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            View::renderView('error', ['message' => 'Internal Server Error']);
            exit();
        }
    }
}
