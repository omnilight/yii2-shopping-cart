<?php

namespace yz\shoppingcart;

use yii\base\Model;

/**
 * Trait CartPositionTrait
 * @property int $quantity Returns quantity of cart position
 * @property int $cost Returns cost of cart position. Default value is 'price * quantity'
 * @package yz\shoppingcart
 */
trait CartPositionTrait
{
    protected $_quantity;

    /**
     * Set position discount sum
     * @param float $price
     * @return void
     */
    public function setDiscountPrice($price)
    {
        $this->discountPrice = $price;
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
        /** @var Model|CartPositionInterface|self $this */
        $cost = $this->getQuantity() * $this->getPrice();
        $costEvent = new CostCalculationEvent();
        $this->trigger(CartPositionInterface::EVENT_COST_CALCULATION, $costEvent);
        if ($withDiscount)
            $cost -= $costEvent->discountValue;
        return $cost;
    }
} 