<?php
// Shared auth guard — include at the top of every admin page.
require_once __DIR__ . '/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
