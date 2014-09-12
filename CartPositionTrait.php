<?php

namespace yz\shoppingcart;

/**
 * Trait CartPositionTrait
 * @property int $quantity Returns quantity of cart position
 * @property int $cost Returns cost of cart position. Default value is 'price * quantity'
 * @package yz\shoppingcart
 */
trait CartPositionTrait
{
    /**
     * Update model on session restore?
     * @var boolean
     */
    private $refresh = true;

    protected $_quantity;

    /**
     * Position discount sum
     * @var float
     */
    private $discountPrice = 0.0;

    /**
     * Set position discount sum
     * @param float $price
     * @return void
     */
    public function setDiscountPrice($price)
    {
        $this->discountPrice = $price;
    }

    /**
     * Get position discount sum
     * @return float
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }

    /**
     * Default implementation for getCost function. Cost is calculated as price * quantity
     * @param bool $withDiscount
     * @return int
     */
    public function getCost($withDiscount = true)
    {
        $fullSum = $this->getQuantity() * $this->getPrice();
        if ($withDiscount)
            $fullSum -= $this->discountPrice;
        return $fullSum;
    }

    /**
     * Magic method. Called on session restore.
     */
    public function __wakeup()
    {
        if ($this->refresh === true)
            $this->refresh();
    }
} 