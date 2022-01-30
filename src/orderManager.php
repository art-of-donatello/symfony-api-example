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

    public function getOrders(array $orders = []) : Collection
    {
        $records = $this->em->getRepository()->findAll();

        dd($records);
    }


    public function saveOrder($order)
    {

        $orderCode = $this -> getRepository () -> findOneBy ( [ "orderCode" => $order[ 'orderCode' ] ] );
        if ( empty( $orderCode ) ) {
            $newOrder = new Order();

            $newOrder -> setProductId ( $order[ 'productId' ] );
            $newOrder -> setOrderCode ( $order[ 'orderCode' ] );
            $newOrder -> setQuantity ( $order[ 'quantity' ] );
            $newOrder -> setShippingDate ( $order[ 'shippingDate' ] );
            $newOrder -> setAdress ( $order[ 'adress' ] );

            $this -> em -> persist ( $newOrder );
            $this -> em -> flush ();

            return $newOrder;

        } else {
            return "This is already saved";
        }


    }

    public function getRepository()
    {
        return $this->em->getRepository(Order::class);
    }
}