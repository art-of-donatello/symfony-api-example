<?php
namespace App;


use App\Entity\Order;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use http\Env\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class orderManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Order Manager Constructor
     */

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * Get All orders
     */

    public function getOrders(string $userid)
    {
        $records = $this->getRepository()->findBy(['userid' => $userid]);

        return $records;
    }


    public function saveOrder($order)
    {

        $orderCode = $this->getOneByOrder( $order[ 'orderCode' ],$order[ 'userid' ] );
        if ( empty( $orderCode ) ) {
            $newOrder = new Order();

            $newOrder -> setProductId ( $order[ 'productId' ] );
            $newOrder -> setOrderCode ( $order[ 'orderCode' ] );
            $newOrder -> setQuantity ( $order[ 'quantity' ] );
            $newOrder -> setShippingDate ( $order[ 'shippingDate' ] );
            $newOrder -> setAdress ( $order[ 'adress' ] );
            $newOrder -> setUserid ($order[ 'userid' ]);


            $this -> em -> persist ( $newOrder );
            $this -> em -> flush ();

            return $newOrder;

        } else {
            return "This is already saved";
        }
    }


    public function updateOrder($order)
    {
        $orderCode = $this -> getOneByOrder ( $order[ 'orderCode'] ,$order[ 'userid' ] );

        if ( ! empty( $orderCode ) && empty( $orderCode -> getShippingDate() ) ) {

            ! empty( $order[ 'productId' ] ) ? $orderCode -> setProductId( $order[ 'productId' ] ) : "";
            ! empty( $order[ 'orderCode' ] ) ? $orderCode -> setOrderCode( $order[ 'orderCode' ] ) : "";
            ! empty( $order[ 'quantity' ] ) ? $orderCode -> setQuantity( $order[ 'quantity' ] ) : "";
            ! empty( $order[ 'shippingDate' ] ) ? $orderCode -> setShippingDate( $order[ 'shippingDate' ] ) : "";
            ! empty( $order[ 'adress' ] ) ? $orderCode -> setAdress( $order[ 'adress' ] ) : "";


            $this -> em -> persist( $orderCode );
            $this -> em -> flush();
            $orderCode = $this -> getOneByOrder( $order[ 'orderCode' ],$order[ 'userid' ] );
            return $orderCode;

        } elseif ( ! empty( $orderCode -> getShippingDate() ) ) {
            return " Shipping date already entered";
        } else {
            return "order not found ";
        }

    }

    public function getOneByOrder(string $OrderCode,$userid) :? Order
    {
        return $this->getRepository()->findOneBy(['orderCode' => $OrderCode,'userid' => $userid]);
    }

    public function getRepository()
    {
        return $this->em->getRepository(Order::class);
    }
}