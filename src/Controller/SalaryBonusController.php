<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalaryBonusController extends AbstractController
{
    /**
     * @Route("/salary/bonus", name="salary_bonus")
     */
    public function index(): Response
    {
        return $this->render('admin/salary_bonus/index.html.twig', [
            'controller_name' => 'SalaryBonusController',
        ]);
    }
}
