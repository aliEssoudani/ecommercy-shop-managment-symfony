<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;

use App\Form\ProductsType;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use App\Repository\StoresRepository;
use App\servecies\CategoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;

class ProductsController extends AbstractController
{
    private $em = null;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/products", name="products")
     */
    public function index(ProductsRepository $products): Response
    {

        if(isset($_POST['delete']) && isset($_POST['id'])){
            $product=$products->find($_POST['id']);

            $this->em->remove($product);
            $this->em->flush();
            $categories = $products->findAll();
            $names = [];
            $stores = [];
            foreach ($categories as $category) {
                $store = $category->getStores()->getName();
                array_push($stores, $store);
            }
            foreach ($categories as $category) {
                $name = $category->getCategories()->getTitle();
                array_push($names, $name);
            }


            return  $this->render('admin/products/index.html.twig',
                ['products' => $products->findAll(),
                'name' => $names,
                'stores' => $stores
            ]);
        }
        $categories = $products->findAll();
        $names = [];
        $stores = [];
        foreach ($categories as $category) {
            $store = $category->getStores()->getName();
            $name = $category->getCategories()->getTitle();
            array_push($stores, $store);
            array_push($names, $name);
        }

        return $this->render('admin/products/index.html.twig',

            ['products' => $products->findAll(),
                'name' => $names,
                'stores' => $stores
            ]);

    }

    /**
     * @Route("/products/create", name="products_create", methods={"GET", "POST"})
     */

    public function create(Request $request, CategoriesRepository $categories, StoresRepository $stores)
    {
        $product = new Products();
        $categoryy = new Categories();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && isset($_POST['categories'])) {
            $categoryADD = $categories->find($_POST['categories']);
            $categoryy = $categoryADD->getTitle();
            var_dump($categoryy);
            $product->setStores($categoryADD->getStores());
            $product->setCategories($categoryADD);
            $this->em->persist($product);
            $this->em->flush();
            return $this->redirectToRoute("products");
        }

        return $this->render('admin/products/create.html.twig', [
            "form" => $form->createView(),
            'categories' => $categories->findAll(),
            'stores' => $stores->findAll(),
            'category' => $categoryy
        ]);
    }

    /**
     * @Route("/{id}/edit", name="products_edit", methods={"GET","POST","Update"})
     */
    public function edit( Request $request,Products $product,CategoriesRepository $categories): Response
    {
        $cat=$product->getCategories()->getTitle();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && isset($_POST['categories']) ){
           $product= $form->getData();

           $product->setCategories($categories->find($_POST['categories']));
            $product->setStores($categories->find($_POST['categories'])->getStores());
            $this->em->flush();
            return $this->redirectToRoute('products');
        }
        return $this->render('admin/products/edit.html.twig', [
            "form" => $form->createView(),
            "categories"=>$categories->findAll(),
            "cat"=>$cat
        ]);
    }
    /**
     * @Route("delete/{id}", name="products_delete", methods={"GET","DELETE"})
     */
    public function delete($id): Response
    {



        $product = $this->getDoctrine()->getRepository(Products::class)->find($id);
       // var_dump($product);
        $this->em->remove($product);
        $this->em->flush();

        return $this->redirectToRoute('products');



    }
}
