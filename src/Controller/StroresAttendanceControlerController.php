<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StroresAttendanceControlerController extends AbstractController
{
    /**
     * @Route("/strores/attendance/controler", name="strores_attendance_controler")
     */
    public function index(): Response
    {
        return $this->render('stores/strores_attendance_controler/index.html.twig', [
            'controller_name' => 'StroresAttendanceControlerController',
        ]);
    }
}
