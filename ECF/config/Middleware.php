<?php

namespace config;

class Middleware
{
    function authMiddleware()
    {
        if (!isset($_SESSION["id"])) {
            header("Location: /Back-end/ECF/Users/deconnexion");
            exit();
        }
    }
    public function roleMiddleware($idr)
    {
        if ($idr < 2) {
            header("Location: /Back-end/ECF/Users/deconnexion");
            exit();
        }
    }
}
