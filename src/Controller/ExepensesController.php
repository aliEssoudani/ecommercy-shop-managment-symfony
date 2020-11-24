<?php

namespace App\Controller;

use App\Entity\Expenses;
use App\Entity\Stores;
use App\Form\ExpensesType;
use App\Form\StoresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExepensesController extends AbstractController
{
    private $em = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/expenses", name="expenses")
     */
    public function index(): Response
    {
        $expenses=$this->getDoctrine()->getRepository(Expenses::class)->findAll();
        return $this->render('admin/expenses/index.html.twig',

            ['expenses' =>$expenses

            ]);

    }

    /**
     * @Route("expenses/new", name="expenses_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $expenses = new Expenses();

        $form = $this->createForm(ExpensesType::class, $expenses);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $expenses->setCreationDate(new \DateTime('now'));
            $this->em->persist($expenses);
            $this->em->flush();
            return $this->redirectToRoute("expenses");
        }

        return $this->render('admin/expenses/new.html.twig', [
            "form" => $form->createView(),


        ]);
    }
    /**
     * @Route("/{id}/delete_expenses", name="expenses_delete")
     */
    public function delete($id): Response
    {
        $expenses = $this->getDoctrine()->getRepository(Expenses::class)->find($id);
        $this->em->remove($expenses);
        $this->em->flush();
        return $this->redirectToRoute('expenses');

    }
    /**
     * @Route("/edit_expenses/{id}/", name="expenses_edit")
     */
    public function edit(Request $request, Expenses $expenses): Response
    {

        $form = $this->createForm(ExpensesType::class, $expenses);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $expenses= $form->getData();
            $this->em->flush();
            return $this->redirectToRoute('expenses');
        }
        return $this->render('admin/expenses/edit.html.twig', [
            "form" => $form->createView(),

        ]);
    }
}
