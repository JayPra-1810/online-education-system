<?php

class AuthMiddleware {

    public static function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            // Robust check: Verify user still exists in DB (important after seeds/resets)
            $db = new Database;
            $db->query("SELECT id FROM users WHERE id = :id");
            $db->bind(':id', $_SESSION['user_id']);
            $db->single();
            
            if ($db->rowCount() > 0) {
                return true;
            } else {
                // User ID in session is invalid (likely deleted/database reset)
                Session::destroy();
                return false;
            }
        }
        return false;
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            Session::flash('auth_error', 'Please log in to access this page.', 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4');
            header('Location: ' . URL_ROOT . '/users/login');
            exit;
        }
    }

    public static function requireRole($role) {
        self::requireLogin();
        
        if ($_SESSION['user_role'] != $role) {
            Session::flash('auth_error', 'You do not have permission to access this page.', 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4');
            header('Location: ' . URL_ROOT);
            exit;
        }
    }
}
