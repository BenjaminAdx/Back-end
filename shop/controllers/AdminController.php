<?php

namespace controllers;

use models\UsersRepository;

class AdminController
{
    public function index()
    {
        $page = "views/AdminAccueil.phtml";
        require_once "views/Base.phtml";
    }
    public function users()
    {
        $data = new UsersRepository();
        $result = $data->findAll();
        $page = "views/AdminUsers.phtml";
        require_once "views/Base.phtml";
    }
}
