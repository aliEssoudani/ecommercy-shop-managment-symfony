<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Employes;
use App\Entity\Products;
use App\Entity\Stores;
use App\Form\EmployesType;
use App\Form\ProductsType;
use App\Repository\CategoriesRepository;
use App\Repository\EmployesRepository;
use App\Repository\ProductsRepository;
use App\Repository\StoresRepository;
use App\servecies\CategoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployesController extends AbstractController
{
    private $em = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/employes", name="employes")
     */
    public function index(): Response
    {
        $employees = $this->getDoctrine()->getRepository(Employes::class)->findAll();
        $stores = [];
        foreach ($employees as $employee) {
            $name = $employee->getStores()->getName();
            array_push($stores, $name);
        }
        return $this->render('admin/employes/index.html.twig',

            ['employees' =>$employees,
                'stores' => $stores
            ]);

    }
    /**
     * @Route("/new", name="employes_new", methods={"GET","POST"})
     */
    public function new(Request $request,EmployesRepository $employes,StoresRepository $stores): Response
    {
        $employe = new Employes();

        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && isset($_POST['stores'])) {
            $storeADD = $stores->find($_POST['stores']);

            $employe->setStores($storeADD);

            $this->em->persist($employe);
            $this->em->flush();
            return $this->redirectToRoute("employes");
        }

        return $this->render('admin/employes/new.html.twig', [
            "form" => $form->createView(),
            'employes' => $employes->findAll(),
            'stores' => $stores->findAll(),

        ]);
    }
    /**
     * @Route("delete/{id}", name="employes_delete", methods={"GET","DELETE"})
     */
    public function delete($id): Response
    {
        $employe = $this->getDoctrine()->getRepository(Employes::class)->find($id);
        $this->em->remove($employe);
        $this->em->flush();
        return $this->redirectToRoute('employes');

    }

    /**
     * @Route("/{id}/edit", name="employes_edit")
     */
    public function edit(Request $request, Employes $employes): Response
    {
        $sto=$employes->getStores()->getName();
        $form = $this->createForm(EmployesType::class, $employes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && isset($_POST['stores']) ){
            $employes= $form->getData();

            $employes->setStores($this->getDoctrine()->getRepository(Stores::class)->find($_POST['stores']));
            $this->em->flush();
            return $this->redirectToRoute('employes');
        }
        $stores= $this->getDoctrine()->getRepository(Stores::class)->findAll();
        return $this->render('admin/employes/edit.html.twig', [
            "form" => $form->createView(),
            "stores"=>$stores,
            "sto"=>$sto
        ]);
    }
}
