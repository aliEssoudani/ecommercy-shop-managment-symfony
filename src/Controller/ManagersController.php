<?php

namespace App\Controller;

use App\Entity\Expenses;
use App\Entity\Managers;
use App\Form\ExpensesType;
use App\Form\ManagersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagersController extends AbstractController
{
    private $em = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/managers", name="managers")
     */
    public function index(): Response
    {
        $managers=$this->getDoctrine()->getRepository(Managers::class)->findAll();
        return $this->render('admin/managers/index.html.twig',

            ['managers' =>$managers

            ]);

    }

    /**
     * @Route("managers/new", name="managers_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $managers = new Managers();

        $form = $this->createForm(ManagersType::class, $managers);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && isset($_POST['roles'])) {
            $managers->setCreationDate(new \DateTime('now'));
            $managers->setRole($_POST['roles']);
            $this->em->persist($managers);
            $this->em->flush();
            return $this->redirectToRoute("managers");
        }

        return $this->render('admin/managers/new.html.twig', [
            "form" => $form->createView(),


        ]);
    }
    /**
     * @Route("/{id}/delete_manager", name="managers_delete")
     */
    public function delete($id): Response
    {
        $managers = $this->getDoctrine()->getRepository(Managers::class)->find($id);
        $this->em->remove($managers);
        $this->em->flush();
        return $this->redirectToRoute('managers');

    }
    /**
     * @Route("/edit_manager/{id}/", name="managers_edit")
     */
    public function edit(Request $request, Managers $managers): Response
    {

        $form = $this->createForm(ManagersType::class, $managers);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && isset($_POST['roles'])){
            $managers->setRole($_POST['roles']);
            $managers= $form->getData();

            $this->em->flush();
            return $this->redirectToRoute('managers');
        }
        return $this->render('admin/managers/edit.html.twig', [
            "form" => $form->createView(),

        ]);
    }
}
