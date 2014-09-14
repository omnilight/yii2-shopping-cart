<?php

namespace yz\shoppingcart;

use yii\base\Event;


/**
 * Class CostCalculationEvent
 * @package \yz\shoppingcart
 */
class CostCalculationEvent extends Event
{
    /**
     * Discount value that could be filled by the cart's behaviors that should provide discounts.
     * This value will be subtracted from the cart's cost
     * @var int
     */
    public $discountValue = 0;
} 