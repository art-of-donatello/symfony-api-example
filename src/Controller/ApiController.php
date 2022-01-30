<?php

namespace App\Controller;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\orderManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\User;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }


    /**
     * @Route("/createorder",name="ordercreate")
     */
    public function createorder(Request $request,orderManager $orderManager,SerializerInterface  $serializer): Response
    {
        $orderCode    = $request->request->get( 'orderCode' );
        $productId    = $request->request->get( 'productId' );
        $quantity     = $request->request->get( 'quantity' );
        $adress       = $request->request->get( 'adress' );
        $shippingDate = $request->request->get( 'shippingDate' );
        $userid = $this->getUser()->getId();
        $order=['orderCode'=>$orderCode,'productId' => $productId,'quantity' => $quantity,'adress' => $adress,'shippingDate' => $shippingDate,'userid' =>  $userid   ];

        $save = $orderManager->saveOrder($order);
        //$save = $serializer->serialize($save,'json');

        return $this->json([
            'message' => $save,
        ]);

    }

    /**
     * @Route("/updateorder",name="updateorder")
     */
    public function updateorder(orderManager $orderManager, Request $request): Response
    {
        $orderCode    = $request->request->get( 'orderCode' );
        $productId    = $request->request->get( 'productId' );
        $quantity     = $request->request->get( 'quantity' );
        $adress       = $request->request->get( 'adress' );
        $shippingDate = $request->request->get( 'shippingDate' );

        $userid = $this->getUser()->getId();
        $order=['orderCode'=>$orderCode,'productId' => $productId,'quantity' => $quantity,'adress' => $adress,'shippingDate' => $shippingDate,'userid' =>  $userid   ];

        $save = $orderManager->updateOrder($order);

        return $this->json([
            'message' => $save ,
        ]);

    }

    /**
     * @Route("/getorders",name="Orders")
     */
    public function getorders(orderManager $orderManager): Response
    {   $userid = $this->getUser()->getId();

        $orders = $orderManager->getOrders($userid);
        return $this->json([
            $orders
        ]);
    }


    /**
     * @Route("{id}/getorder",name="Orders")
     */
    public function getorder(string $ordercode,orderManager $orderManager,Request $request): Response
    {

        $userid = $this->getUser()->getId();

        $orders = $orderManager->getOneByOrder($ordercode,$userid);
        return $this->json([
            $orders
        ]);
    }


}
