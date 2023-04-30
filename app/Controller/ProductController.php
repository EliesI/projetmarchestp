<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

     /**
     * @Route("/api/products", name="get_products", methods={"GET"})
     */
    public function getProducts(): JsonResponse
    {
        $products = $this->productRepository->findAll();

        $formattedProducts = [];
        foreach ($products as $product) {
            $formattedProducts[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'photo' => $product->getPhoto(),
                'price' => $product->getPrice(),
                'category' => $product->getCategory(),
                'collection' => $product->getCollection(),
            ];
        }
    
        return $this->json($formattedProducts);
    }

    /**
     * @Route("/api/products/{id}", name="get_product", methods={"GET"})
     */
    public function getProduct(int $id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        $formattedProducts = [];
        $formattedProducts[] = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'photo' => $product->getPhoto(),
            'price' => $product->getPrice(),
            'category' => $product->getCategory(),
            'collection' => $product->getCollection(),
        ];

        return $this->json($formattedProducts);
    }

    /**
    * @Route("/api/products", name="add_product", methods={"POST"})
    * @IsGranted("ROLE_ADMIN")
    */
    public function addProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPhoto($data['photo']);
        $product->setPrice($data['price']);
        $product->setCategory($data['category']);
        $product->setCollection($data['collection']);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();
        
        return $this->json($product);
    }

    /**
    * @Route("/api/products/{id}", name="update_product", methods={"PUT"})
    * @IsGranted("ROLE_ADMIN")
    */
    public function updateProduct(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        if (isset($data['name'])) {
            $product->setName($data['name']);
        }

        if (isset($data['description'])) {
            $product->setDescription($data['description']);
        }

        if (isset($data['photo'])) {
            $product->setPhoto($data['photo']);
        }

        if (isset($data['price'])) {
            $product->setPrice($data['price']);
        }

        if (isset($data['category'])) {
            $product->setCategory($data['category']);
        }

        if (isset($data['collection'])) {
            $product->setCollection($data['collection']);
        }

        $entityManager->flush();

        return $this->json($product);
    }

    /**
    * @Route("/api/products/{id}", name="delete_product", methods={"DELETE"})
    * @IsGranted("ROLE_ADMIN")
    */
    public function deleteProduct(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->json(['message' => 'Product deleted.']);
    }
}
