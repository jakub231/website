<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class States extends AbstractController
{

    public function index()
    {
        return $this->render('states/index.html.twig', [
            'controller_name' => 'States',
        ]);
    }
}
