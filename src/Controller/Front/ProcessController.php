<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Database\DBConnection;
class ProcessController extends AbstractController
{
    public function __invoke()
    {
        $db = new DBConnection($_ENV['DATABASE_NAME'], $_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
        $this->render('process.php', 'Front');
    }
}
