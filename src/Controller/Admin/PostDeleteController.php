<?php

namespace App\Controller\Admin;

use App\Exception\PostNotFoundException;
use App\Repository\PostRepository;

class PostDeleteController extends AdminController
{
    public function __invoke()
    {
        try {
            if (isset($_POST['delete_post'])) {
                PostRepository::deletePost($_POST['delete_post']);
            }
            $this->redirectToUrl('/admin');
        } catch (PostNotFoundException $exception) {
                $this->redirectToUrl();
        }
    }
}
