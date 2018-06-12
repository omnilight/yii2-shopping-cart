<?php

namespace yz\shoppingcart;

use yii\base\Event;


/**
 * Class ShippingCostCalculationEvent
 * @package \yz\shoppingcart
 */
class ShippingCostCalculationEvent extends Event
{
    /**
     * Shipping value that could be filled by the cart's behaviors that should provide shippings methods.
     * This value will be added to the cart's cost
     * @var float
     */
    public $shippingValue = 0;
} 