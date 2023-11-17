<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;
use App\Service\PriceCalculator;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form ->handleRequest($request);


        $products = $productRepository->findSearch($data); 
         
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }
 
    
// Mettre le calcul dans le controller pour l'afficher dans la vue

    public function show(Product $product, PriceCalculator $priceCalculator): Response
    {
        $discountedPrice = $priceCalculator->calculateDiscountedPrice($product);

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'discountedPrice' => $discountedPrice,
        ]);
    }
}

