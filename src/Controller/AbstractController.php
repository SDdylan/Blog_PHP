<?php

namespace App\Controller;

abstract class AbstractController
{
    protected function render(string $templateName, string $folderName, array $content = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(ROOTPATH . '/src/View/'.$folderName);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render($templateName, $content);
    }
}