<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\Employes;
use App\Entity\Stores;
use App\Form\AttendanceType;
use App\Form\StoresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttendanceController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/attendance", name="attendance")
     */
    public function index(): Response
    {
        $employes=$this->getDoctrine()->getRepository(Employes::class)->findAll();
        $attendance=$this->getDoctrine()->getRepository(Attendance::class)->findAll();
        return $this->render('stores/attendance/index.html.twig', [
            'employes'=>$employes,
            'attendance'=>$attendance
        ]);
    }
    /**
     * @Route("/attendance_new", name="attendance_new")
     */
    public function new(): Response
    {
        $attendance="heyyyy";
        if(isset($_POST['employee']) && isset($_POST['check'])) {
            $employes = $this->getDoctrine()->getRepository(Employes::class)->findAll();
            $emp = $this->getDoctrine()->getRepository(Employes::class)->find($_POST['employee']);
            $criteria = $_POST['employee'];
            $attendance = $this->getDoctrine()->getRepository(Attendance::class)->findOneBy(['employes' => $criteria]);
            if ($_POST['check'] == "checkIn") {
                if (!$attendance) {
                    $attendance = new Attendance();
                    $attendance->setIsValide(false);
                    $attendance->setEmployes($emp);
                    $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
                    $attendance->setCheckOut(new \DateTime('now'));
                    $attendance->setCheckIn(new \DateTime('now'));
                    $this->em->persist($attendance);
                    $this->em->flush();
                }
            } elseif ($_POST['check'] == "checkOut") {
                if ($attendance && !$attendance->getIsValide()) {
                    $dateIn=$attendance->getCheckIn()->format('d');
                    $dateOut=(new \DateTime('now'))->format('d');
                    if($dateIn === $dateOut){
                        $attendance->setCheckOut(new \DateTime('now'));
                        $attendance->setIsValide(true);
                        $this->em->flush();
                    }

                }
            }
        }
       $employes=$this->getDoctrine()->getRepository(Employes::class)->findAll();
        return $this->render('stores/attendance/new.html.twig', [
           'employes'=>$employes,
            'attendance'=>$attendance
        ]);
    }
}
