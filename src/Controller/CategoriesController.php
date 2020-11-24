<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use App\Repository\StoresRepository;
use App\servecies\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="categories", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
       // if ($this->isGranted(['ROLE_ADMIN'])){
            return $this->render('admin/categories/index.html.twig', ['categories' => $categoriesRepository->findAll()]);
        //}
      //  return $this->redirectToRoute('home');
    }

    /**
     * @Route("/admin/new", name="categories_new", methods={"GET","POST"})
     */
    public function new(StoresRepository $stores): Response
    {
        if(isset($_POST['title']) && isset($_POST['stores'])  ) {
            $service=new CategoryService( $this->getDoctrine()->getManager());
            $storeAdd=$stores->find($_POST['stores']);
            $service->add($_POST['title'],$storeAdd);
            return $this->redirectToRoute('categories');
        }
        return $this->render('admin/categories/new.html.twig', [
             'stores' =>$stores->findAll()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="categories_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        return $this->render('admin/categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="categories_edit", methods={"GET","POST"})
     */
    public function edit( Categories $category): Response
    {
        if(isset($_POST['title']) ){
            $service=new CategoryService( $this->getDoctrine()->getManager());
            $service->update($_POST['title'],$category);
            return $this->redirectToRoute('categories');
        }
        return $this->render('admin/categories/edit.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/{id}", name="categories_delete", methods={"DELETE"})
     */
    public function delete( Categories $category): Response
    {
        if(isset($_POST['delete']) ){
            $id=$category->getId();
            $service=new CategoryService( $this->getDoctrine()->getManager());
            $service->delete($id);
            return $this->redirectToRoute('categories');
        }
        return $this->render('admin/categories/_delete_form.html.twig', [
        ]);
    }
}
