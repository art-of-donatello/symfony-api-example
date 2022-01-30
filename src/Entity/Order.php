<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="Orders")
     */

class Order
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $orderCode;
    /**
     * @ORM\Column(type="string")
     */
    private $productId;
    /**
     * @ORM\Column(type="string")
     */
    private $quantity;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $adress;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $shippingDate;


    /**
     *
     *@ORM\Column(type="integer", nullable=false)
     */
    private $userid;

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this -> userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid( $userid ): void
    {
        $this -> userid = $userid;
    }




    /**
     * @return mixed
     */
    public function getOrderCode()
    {
        return $this->orderCode;
    }

    /**
     * @param mixed $orderCode
     */
    public function setOrderCode( $orderCode ): void
    {
        $this->orderCode = $orderCode;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId( $productId ): void
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity( $quantity ): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress( $adress ): void
    {
        $this->adress = $adress;
    }

    /**
     * @return mixed
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     * @param mixed $shippingDate
     */
    public function setShippingDate( $shippingDate ): void
    {
        $this->shippingDate = $shippingDate;
    }


}