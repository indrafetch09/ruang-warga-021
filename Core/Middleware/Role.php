<?php

namespace Core\Middleware;

use Core\Authenticator;

class Role
{
    /**
     * Memastikan user yang login memiliki role yang diizinkan
     */
    public function handle(array $allowedRoles = [])
    {
        if (!Authenticator::check()) {
            redirect('/login');
        }

        $userRole = Authenticator::role();

        if (!empty($allowedRoles) && !in_array($userRole, $allowedRoles, true)) {
            abort(403);
        }
    }
}
