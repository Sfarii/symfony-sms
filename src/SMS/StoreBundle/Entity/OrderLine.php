<?php

namespace SMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * OrderLine
 *
 * @ORM\Table(name="order_line")
 * @ORM\Entity(repositoryClass="SMS\StoreBundle\Repository\OrderLineRepository")
 */
class OrderLine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * Many Products have One OrederLine.
     * @ORM\ManyToOne(targetEntity="Product" ,fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * Many OrderLines have One orderProvider.
     * @ORM\ManyToOne(targetEntity="OrderProvider", inversedBy="orderLines" ,fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="order_provider_id", referencedColumnName="id")
     */
    private $orderProvider;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return OrderLine
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return OrderLine
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set product
     *
     * @param \SMS\StoreBundle\Entity\Product $product
     *
     * @return OrderLine
     */
    public function setProduct(\SMS\StoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \SMS\StoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set provider
     *
     * @param \SMS\StoreBundle\Entity\Provider $provider
     *
     * @return OrderLine
     */
    public function setProvider(\SMS\StoreBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \SMS\StoreBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set user
     *
     * @param \SMS\UserBundle\Entity\User $user
     *
     * @return OrderLine
     */
    public function setUser(\SMS\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SMS\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set establishment
     *
     * @param \SMS\EstablishmentBundle\Entity\Establishment $establishment
     *
     * @return OrderLine
     */
    public function setEstablishment(\SMS\EstablishmentBundle\Entity\Establishment $establishment = null)
    {
        $this->establishment = $establishment;

        return $this;
    }

    /**
     * Get establishment
     *
     * @return \SMS\EstablishmentBundle\Entity\Establishment
     */
    public function getEstablishment()
    {
        return $this->establishment;
    }

    /**
     * Set orderProvider
     *
     * @param \SMS\StoreBundle\Entity\OrderProvider $orderProvider
     *
     * @return OrderLine
     */
    public function setOrderProvider(\SMS\StoreBundle\Entity\OrderProvider $orderProvider = null)
    {
        $this->orderProvider = $orderProvider;

        return $this;
    }

    /**
     * Get orderProvider
     *
     * @return \SMS\StoreBundle\Entity\OrderProvider
     */
    public function getOrderProvider()
    {
        return $this->orderProvider;
    }
}
