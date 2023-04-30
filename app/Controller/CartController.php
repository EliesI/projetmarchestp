<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\Order;
use App\Repository\CartRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CartController extends AbstractController
{
    /**
    * @Route("/api/carts", name="cart", methods={"GET"})
    * @IsGranted("ROLE_USER")
    */
    public function index(CartRepository $cartRepository, SerializerInterface $serializer): JsonResponse
    {
        $user = $this->getUser();
        $cart = $cartRepository->findOneBy(['user' => $user]);

        if (!$cart) {
            $cart = new Cart();
            $cart->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();
        }

        $productIds = $cart->getProducts()->map(fn(Product $product) => $product->getId())->toArray();
        $jsonProductsList = $serializer->serialize($productIds, 'json');

        return new JsonResponse($jsonProductsList, Response::HTTP_OK, [], true);
    }

    /**
    * @Route("/api/carts/{id}", name="cart_add", methods={"POST"})
    * @ParamConverter("product", class="App\Entity\Product")
    * @IsGranted("ROLE_USER")
    */
    public function addToCart(Request $request, EntityManagerInterface $entityManager, Product $product): JsonResponse
    {
        $user = $this->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);

        if (!$cart) {
            $cart = new Cart();
            $cart->setUser($user);
            $entityManager->persist($cart);
        }

        $products = $cart->getProducts();

        if (!$products->contains($product)) {
            $cart->addProduct($product);
            $cart->setPrice($cart->getPrice() + $product->getPrice());
        }

        $entityManager->flush();

        $response = [
            'success' => true,
            'message' => 'Product added to cart',
        ];

        return new JsonResponse($response);
    }

    /**
    * @Route("/api/carts/{productId}", name="cart_remove", methods={"DELETE"})
    * @IsGranted("ROLE_USER")
    */
    public function removeFromCart(Request $request, EntityManagerInterface $entityManager, int $productId): JsonResponse
    {
        $user = $this->getUser();
        $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);

        if (!$cart) {
            $response = [
                'success' => false,
                'message' => 'Cart not found',
            ];
            return new JsonResponse($response);
        }

        $product = $entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            $response = [
                'success' => false,
                'message' => 'Product not found',
            ];
            return new JsonResponse($response);
        }

        $cart->removeProduct($product);

        $entityManager->flush();

        $response = [
            'success' => true,
            'message' => 'Product removed from cart',
        ];

        return new JsonResponse($response);
    }

/**
 * @Route("/api/cart/confirm", name="cart_validate", methods={"POST"})
 * @IsGranted("ROLE_USER")
 */
public function confirmCart(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
{
    $user = $this->getUser();
    $cart = $entityManager->getRepository(Cart::class)->findOneBy(['user' => $user]);

    if (!$cart) {
        return new JsonResponse(['message' => 'Cart not found'], Response::HTTP_NOT_FOUND);
    }

    $products = $cart->getProducts();

    if ($products->isEmpty()) {
        return new JsonResponse(['message' => 'No products in the cart'], Response::HTTP_BAD_REQUEST);
    }

    $order = new Order();
    $order->setUser($user);
    $order->setCreationDate(new \DateTime());

    $totalPrice = 0;

    foreach ($products as $product) {
        $order->addProduct($product);
        $totalPrice += $product->getPrice();
    }

    $order->setTotalPrice($totalPrice);

    $products->clear();

    $entityManager->persist($order);
    $entityManager->flush();

    $formattedOrder = [
        'id' => $order->getId(),
        'totalPrice' => $order->getTotalPrice(),
        'creationDate' => $order->getCreationDate()->format('Y-m-d H:i:s'),
        'products' => [],
    ];

    foreach ($order->getProducts() as $product) {
        $formattedProduct = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'photo' => $product->getPhoto(),
            'price' => $product->getPrice(),
        ];

        $formattedOrder['products'][] = $formattedProduct;
    }

    $jsonOrder = $serializer->serialize($formattedOrder, 'json');

    return new JsonResponse($jsonOrder, Response::HTTP_OK, [], true);
}



}

?>        