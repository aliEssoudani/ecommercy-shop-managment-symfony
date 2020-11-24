<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Stores;
use App\Form\EmployesType;
use App\Form\StoresType;
use App\Repository\EmployesRepository;
use App\Repository\StoresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoresController extends AbstractController
{
    private $em = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/stores", name="stores")
     */
    public function index(): Response
    {
        $stores=$this->getDoctrine()->getRepository(Stores::class)->findAll();
        return $this->render('admin/stores/index.html.twig',

            ['stores' =>$stores

            ]);

    }

    /**
     * @Route("stores/new", name="stores_new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $store = new Stores();

        $form = $this->createForm(StoresType::class, $store);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $store->setCreationDate(new \DateTime('now'));
            $this->em->persist($store);
            $this->em->flush();
            return $this->redirectToRoute("stores");
        }

        return $this->render('admin/stores/new.html.twig', [
            "form" => $form->createView(),


        ]);
    }
    /**
     * @Route("/{id}/delete_store", name="stores_delete")
     */
    public function delete($id): Response
    {
        $store = $this->getDoctrine()->getRepository(Stores::class)->find($id);
        $this->em->remove($store);
        $this->em->flush();
        return $this->redirectToRoute('stores');

    }
    /**
     * @Route("/edit_store/{id}/", name="stores_edit")
     */
    public function edit(Request $request, Stores $stores): Response
    {

        $form = $this->createForm(StoresType::class, $stores);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $stores= $form->getData();
            $this->em->flush();
            return $this->redirectToRoute('stores');
        }
        return $this->render('admin/stores/edit.html.twig', [
            "form" => $form->createView(),

        ]);
    }
}
