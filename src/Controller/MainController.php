<?php
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;

/**
 * MainController
 */
class MainController  extends AbstractBaseController
{
    #[Route('/', options: ['title' => 'Home'])]
    /**
     * HomePage function
     */
    public function HomePage(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('themes/homepage.html.twig', [
        ]);
    }
}