<?php

namespace App\Controller;

use App\Entity\Product;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productList = $entityManager->getRepository(Product::class)->findAll();
        dump($productList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/product-add', name: 'product-add')]
    public function productAdd(): Response
    {
        $product = new Product();
        $product->setTitle('Product '.rand(1, 100));
        $product->setPrice('100');
        $product->setQuantity('10');
        $product->setDescription('Test test');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
