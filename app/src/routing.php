<?php

// Load API routes
if (request()->isApi()) {
    header('Content-Type: application/json; charset=utf-8');
    import(ROUTES_PATH.DS.'api.php');
} // Load Web routes
else {
    header('Content-Type: text/html; charset=utf-8');
    import(ROUTES_PATH.DS.'web.php');
}
