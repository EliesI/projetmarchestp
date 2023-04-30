<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class OrderController extends AbstractController
{
     /**
     * @Route("/api/orders", name="get_orders", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function getOrders(): JsonResponse
    {
        $user = $this->getUser();
        $orders = $user->getOrders();

        $formattedOrders = [];

        foreach ($orders as $order) {
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

            $formattedOrders[] = $formattedOrder;
        }

        return new JsonResponse($formattedOrders, Response::HTTP_OK);
    }

    /**
    * @Route("/api/orders/{id}", name="get_order", methods={"GET"})
    */
    public function getOrder(int $id): JsonResponse
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);

        if (!$order) {
            return new JsonResponse(['message' => 'Order not found'], Response::HTTP_NOT_FOUND);
        }

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

        return new JsonResponse($formattedOrder, Response::HTTP_OK);
    }


}
