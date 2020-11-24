<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoresOrdersController extends AbstractController
{
    /**
     * @Route("/stores/orders", name="stores_orders")
     */
    public function index(): Response
    {

        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        if (isset($_POST['category'])) {

            $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
            $criteria = $_POST['category'];
            $products = $this->getDoctrine()->getRepository(Products::class)->findBy(['categories' => $criteria]);

            return $this->render('stores/stores_orders/index.html.twig', [
                'categories' => $categories,
                'products' => $products
            ]);

        }

        return $this->render('stores/stores_orders/index.html.twig', [
            'categories' => $categories,
            'products' => null
        ]);
    }

    /**
     * @Route("/stores/list", name="stores_list")
     */
    public function list(): Response
    {
        return $this->render('stores/stores_orders/index.html.twig', [

        ]);
    }
}
